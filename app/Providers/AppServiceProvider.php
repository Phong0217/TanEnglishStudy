<?php

namespace App\Providers;

use App\Domain\AI\AiQuestionGeneratorInterface;
use App\Domain\AI\MockAiQuestionGenerator;
use App\Domain\AI\OpenAiQuestionGenerator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(AiQuestionGeneratorInterface::class, function () {
            return match (config('services.ai.provider')) {
                'openai' => app(OpenAiQuestionGenerator::class),
                'mock' => app()->environment(['local', 'testing']) ? app(MockAiQuestionGenerator::class) : throw new \RuntimeException('Mock AI is only available in local and test environments. Configure AI_PROVIDER=openai and AI_API_KEY.'),
                default => throw new \RuntimeException('Configure a supported AI provider.'),
            };
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Vite::prefetch(concurrency: 3);
        Model::preventLazyLoading(! app()->isProduction());
    }
}
