<?php

namespace App\Jobs;

use App\Domain\AI\AiQuestionGeneratorInterface;
use App\Domain\AI\GenerateEnglishBatch;
use App\Models\AiGenerationJob;
use App\Notifications\SystemNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\Middleware\WithoutOverlapping;
use Illuminate\Queue\SerializesModels;
use Throwable;

class GenerateQuestionsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $tries = 3;

    public int $timeout = 75;

    public function __construct(public int $jobId)
    {
        $this->onConnection(config('english-ai.queue_connection'));
    }

    public function middleware(): array
    {
        return [(new WithoutOverlapping('english-ai-'.$this->jobId))->releaseAfter(10)->expireAfter(85)];
    }

    public function backoff(): array
    {
        return [10, 30, 60];
    }

    public function handle(GenerateEnglishBatch $batch): void
    {
        $job = AiGenerationJob::withoutGlobalScopes()->findOrFail($this->jobId);
        if (in_array($job->status, ['CANCELLED', 'COMPLETED', 'FAILED'])) {
            return;
        }
        $job->update(['status' => 'PROCESSING', 'started_at' => $job->started_at ?? now(), 'provider' => config('services.ai.provider'), 'model' => config('services.ai.model'), 'prompt_version' => config('english-ai.prompt_version')]);
        $terminal = $batch->execute($job, app(AiQuestionGeneratorInterface::class));
        if (! $terminal) {
            self::dispatch($job->id)->delay(now()->addSecond());

            return;
        }
        $job->refresh()->load('requester');
        if ($job->status !== 'CANCELLED') {
            $prefix = $job->requester->hasRole('ADMIN') ? '/admin' : '/teacher';
            $job->requester->notify(new SystemNotification('AI generation '.strtolower($job->status), $job->generated_count.' questions available for review.', $prefix.'/ai-jobs/'.$job->id.'/review'));
        }
    }

    public function failed(?Throwable $error): void
    {
        AiGenerationJob::withoutGlobalScopes()->whereKey($this->jobId)->whereNotIn('status', ['COMPLETED', 'CANCELLED'])->update(['status' => 'FAILED', 'error_message' => 'AI service could not complete this batch. Check provider configuration and retry remaining questions.', 'completed_at' => now()]);
    }
}
