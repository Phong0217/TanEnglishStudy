<?php

namespace Tests\Unit;

use App\Domain\Classrooms\StudentClassImportService;
use App\Support\Utf8;
use Illuminate\Http\UploadedFile;
use PHPUnit\Framework\TestCase;
use ReflectionMethod;

class Utf8Test extends TestCase
{
    public function test_windows_1258_csv_text_is_converted_to_valid_utf8(): void
    {
        $value = Utf8::clean("\xE1nh Linh");

        $this->assertSame('ánh Linh', $value);
        $this->assertTrue(mb_check_encoding($value, 'UTF-8'));
    }

    public function test_utf8_bom_is_removed_without_changing_text(): void
    {
        $this->assertSame('student_name', Utf8::clean("\xEF\xBB\xBFstudent_name"));
    }

    public function test_valid_utf8_is_preserved(): void
    {
        $value = 'Nguyễn Thị Ánh';

        $this->assertSame($value, Utf8::clean($value));
    }

    public function test_replacement_markers_are_detected_in_lost_diacritics(): void
    {
        $this->assertTrue(Utf8::containsReplacementMarker('B?o Ng?c'));
        $this->assertFalse(Utf8::containsReplacementMarker('Bảo Ngọc'));
    }

    public function test_correct_vietnamese_name_is_not_rejected(): void
    {
        $name = Utf8::clean('Bảo Ngọc');

        $this->assertSame('Bảo Ngọc', $name);
        $this->assertFalse(Utf8::containsReplacementMarker($name));
    }

    public function test_csv_rows_are_normalized_before_import(): void
    {
        $file = UploadedFile::fake()->createWithContent(
            'students.csv',
            "class_name,student_name,email,password\nEnglish 7A,\xE1nh Linh,linh@example.com,Student123!\n",
        );
        $method = new ReflectionMethod(StudentClassImportService::class, 'rows');
        $method->setAccessible(true);

        $rows = $method->invoke(new StudentClassImportService(), $file);

        $this->assertSame('ánh Linh', $rows[1][1]);
        $this->assertTrue(mb_check_encoding($rows[1][1], 'UTF-8'));
    }

    public function test_excel_float_artifact_is_normalized_for_class_lookup(): void
    {
        $method = new ReflectionMethod(StudentClassImportService::class, 'normalizeClassValue');
        $method->setAccessible(true);

        $this->assertSame('2.3', $method->invoke(new StudentClassImportService(), '2.2999999999999998'));
        $this->assertSame('2.3', $method->invoke(new StudentClassImportService(), '2.3'));
        $this->assertSame('2A', $method->invoke(new StudentClassImportService(), '2A'));
    }
}
