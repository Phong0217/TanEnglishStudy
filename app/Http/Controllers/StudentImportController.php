<?php

namespace App\Http\Controllers;

use App\Domain\Classrooms\StudentClassImportService;
use App\Http\Requests\ImportStudentsRequest;
use Illuminate\Http\RedirectResponse;
use Throwable;

class StudentImportController extends Controller
{
    public function template()
    {
        return response()->streamDownload(function () {
            echo "class_name,student_name,email,password\n";
            echo "English 7A,Nguyen Minh,minh@example.com,Student123!\n";
            echo "English 7A,Tran Lan,lan@example.com,Student123!\n";
        }, 'student-import-template.csv', ['Content-Type' => 'text/csv; charset=UTF-8']);
    }

    public function __invoke(ImportStudentsRequest $request, StudentClassImportService $service): RedirectResponse
    {
        try {
            $result = $service->import($request->user(), $request->file('file'));
            return back()->with('success', "Đã import {$result['created']} học sinh mới, cập nhật {$result['updated']} tài khoản và ghi danh {$result['enrolled']} học sinh.");
        } catch (Throwable $exception) {
            report($exception);
            return back()->withErrors(['file' => $exception->getMessage()]);
        }
    }
}
