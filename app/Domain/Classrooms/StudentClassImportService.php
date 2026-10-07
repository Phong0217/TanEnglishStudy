<?php

namespace App\Domain\Classrooms;

use App\Enums\RoleName;
use App\Models\Classroom;
use App\Models\Enrollment;
use App\Models\StudentProfile;
use App\Models\User;
use App\Support\Utf8;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use RuntimeException;

class StudentClassImportService
{
    public function import(User $actor, UploadedFile $file): array
    {
        $rows = $this->rows($file);
        if (count($rows) < 2) throw new RuntimeException('File phải có dòng tiêu đề và ít nhất một học sinh.');
        $headers = array_map(fn ($header) => $this->header((string) $header), array_shift($rows));
        $classKey = $this->findHeader($headers, ['class', 'class_name', 'classname', 'lop', 'ten_lop']);
        $nameKey = $this->findHeader($headers, ['student_name', 'name', 'student', 'ten_hoc_sinh', 'ho_ten']);
        $emailKey = $this->findHeader($headers, ['email', 'student_email', 'username', 'tai_khoan']);
        $passwordKey = $this->findHeader($headers, ['password', 'mat_khau', 'matkhau']);
        if ($classKey === null || $nameKey === null || $emailKey === null || $passwordKey === null) throw new RuntimeException('Thiếu cột bắt buộc: class_name, student_name, email, password.');

        $result = ['created' => 0, 'updated' => 0, 'enrolled' => 0, 'errors' => []];
        DB::transaction(function () use ($actor, $rows, $headers, $classKey, $nameKey, $emailKey, $passwordKey, &$result) {
            foreach ($rows as $index => $row) {
                $line = $index + 2; $data = array_combine($headers, array_pad($row, count($headers), null)) ?: [];
                $classValue = trim(Utf8::clean($data[$classKey] ?? ''));
                $name = trim(Utf8::clean($data[$nameKey] ?? ''));
                $email = strtolower(trim(Utf8::clean($data[$emailKey] ?? '')));
                $password = (string) ($data[$passwordKey] ?? '');
                if ($classValue === '' || $name === '' || $email === '' || $password === '') { $result['errors'][] = "Dòng {$line}: thiếu lớp, tên, email hoặc mật khẩu."; continue; }
                if (Utf8::containsReplacementMarker($classValue) || Utf8::containsReplacementMarker($name)) {
                    $result['errors'][] = "Dòng {$line}: tên học sinh hoặc tên lớp chứa ký tự '?' do file đã mất dấu. Hãy lưu lại file ở định dạng CSV UTF-8 hoặc XLSX rồi thử lại.";
                    continue;
                }
                $classQuery = Classroom::query()->where('center_id', $actor->center_id)->where(fn ($q) => $q->where('name', $classValue)->orWhere('code', $classValue));
                if ($actor->hasRole(RoleName::TEACHER->value)) $classQuery->whereHas('teacherAssignments', fn ($q) => $q->where('teacher_id', $actor->id)->where('status', 'ACTIVE'));
                $classroom = $classQuery->first();
                if (! $classroom) { $result['errors'][] = "Dòng {$line}: lớp '{$classValue}' không tồn tại hoặc bạn không có quyền."; continue; }
                $student = User::role(RoleName::STUDENT->value)->where('center_id', $actor->center_id)->where('email', $email)->first();
                if ($student) {
                    $student->update(['name' => $name, 'password' => Hash::make($password), 'status' => 'ACTIVE']);
                    if (! $student->studentProfile) {
                        StudentProfile::create(['user_id' => $student->id, 'student_code' => $this->studentCode($student), 'joined_at' => now()->toDateString()]);
                    }
                    $result['updated']++;
                } else {
                    $student = User::create(['center_id' => $actor->center_id, 'name' => $name, 'email' => $email, 'password' => Hash::make($password), 'status' => 'ACTIVE']);
                    $student->assignRole(RoleName::STUDENT->value);
                    StudentProfile::create(['user_id' => $student->id, 'student_code' => $this->studentCode($student), 'joined_at' => now()->toDateString()]);
                    $result['created']++;
                }
                $enrollment = Enrollment::updateOrCreate(['classroom_id' => $classroom->id, 'student_id' => $student->id], ['status' => 'ACTIVE', 'enrolled_at' => now(), 'completed_at' => null, 'withdrawn_at' => null, 'created_by' => $actor->id, 'updated_by' => $actor->id]);
                if ($enrollment->wasRecentlyCreated) $result['enrolled']++;
            }
            if ($result['errors']) throw new RuntimeException(implode(' ', $result['errors']));
        });
        return $result;
    }

    private function rows(UploadedFile $file): array
    {
        if (in_array(strtolower($file->getClientOriginalExtension()), ['csv', 'txt'], true)) {
            $lines = file($file->getRealPath(), FILE_IGNORE_NEW_LINES);

            if ($lines === false) {
                throw new RuntimeException('Không thể đọc file CSV.');
            }

            return array_map(
                fn ($line) => array_map(fn ($cell) => Utf8::clean($cell), str_getcsv(Utf8::clean($line))),
                $lines,
            );
        }

        if (! class_exists(\ZipArchive::class)) throw new RuntimeException('Máy chủ chưa bật ZipArchive để đọc file XLSX.');
        $zip = new \ZipArchive(); if ($zip->open($file->getRealPath()) !== true) throw new RuntimeException('Không thể đọc file XLSX.');
        $shared = [];
        if (($xml = $zip->getFromName('xl/sharedStrings.xml')) !== false) {
            $doc = simplexml_load_string($xml);

            if ($doc !== false) {
                foreach ($doc->si as $item) {
                    $value = isset($item->t)
                        ? (string) $item->t
                        : implode('', array_map('strval', $item->r->t ?? []));
                    $shared[] = Utf8::clean($value);
                }
            }
        }

        $sheetXml = $zip->getFromName('xl/worksheets/sheet1.xml');
        $sheet = $sheetXml === false ? false : simplexml_load_string($sheetXml);
        if ($sheet === false) {
            $zip->close();
            throw new RuntimeException('Không thể đọc worksheet đầu tiên của file XLSX.');
        }

        $out = [];
        foreach ($sheet->sheetData->row as $row) {
            $values = [];
            foreach ($row->c as $cell) {
                $value = (string) $cell->v;
                if ((string) $cell['t'] === 's') $value = $shared[(int) $value] ?? '';
                $values[] = Utf8::clean($value);
            }
            $out[] = $values;
        }
        $zip->close(); return $out;
    }

    private function header(string $value): string { return Str::of(Utf8::clean($value))->lower()->ascii()->replaceMatches('/[^a-z0-9]+/', '_')->trim('_')->value(); }
    private function findHeader(array $headers, array $aliases): ?string { foreach ($aliases as $alias) if (in_array($alias, $headers, true)) return $alias; return null; }
    private function studentCode(User $student): string { return 'STU-'.$student->id; }
}
