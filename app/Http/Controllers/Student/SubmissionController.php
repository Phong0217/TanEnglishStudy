<?php

namespace App\Http\Controllers\Student;

use App\Domain\Assessment\SubmissionService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Assessment\SaveAnswerRequest;
use App\Models\AssignmentDelivery;
use App\Models\Submission;
use App\Support\Logging\AppLogger;
use App\Enums\LogService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class SubmissionController extends Controller
{
    public function start(Request $request, AssignmentDelivery $delivery, SubmissionService $service, AppLogger $logger): JsonResponse
    {
        try {
            $submission = $service->start($request->user(), $delivery);
        } catch (ValidationException $exception) {
            $logger->warning(LogService::SUBMISSION, 'Assignment start rejected', [
                'delivery_id' => $delivery->id,
                'reason' => $exception->getMessage(),
            ]);
            throw $exception;
        }

        $logger->info(LogService::SUBMISSION, 'Assignment attempt started', [
            'delivery_id' => $delivery->id,
            'submission_id' => $submission->id,
            'attempt_number' => $submission->attempt_number,
        ]);

        return response()->json(['success' => true, 'message' => 'Attempt ready.', 'data' => $submission], $submission->wasRecentlyCreated ? 201 : 200);
    }

    public function save(SaveAnswerRequest $request, Submission $submission, SubmissionService $service): JsonResponse
    {
        $answer = $service->saveAnswer($request->user(), $submission, (int) $request->validated('assignment_item_id'), $request->validated('response'));

        return response()->json(['success' => true, 'message' => 'Answer saved.', 'data' => ['answer' => $answer, 'savedAt' => now()]]);
    }

    public function submit(Request $request, Submission $submission, SubmissionService $service): JsonResponse
    {
        $result = $service->submit($request->user(), $submission);

        return response()->json(['success' => true, 'message' => 'Assignment submitted successfully.', 'data' => $result]);
    }
}
