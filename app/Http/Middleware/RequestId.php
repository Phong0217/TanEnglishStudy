<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Support\Logging\AppLogger;
use App\Enums\LogService;
use Throwable;

class RequestId
{
    public function handle(Request $request, Closure $next)
    {
        $logger = app(AppLogger::class);
        $candidate = (string) $request->header('X-Request-ID', '');
        $requestId = preg_match('/^[A-Za-z0-9._:-]{8,100}$/', $candidate) ? $candidate : 'req_'.Str::ulid();
        $request->attributes->set('request_id', $requestId);
        $started = microtime(true);
        $logger->debug($this->service($request), 'Request started', ['method' => $request->method(), 'route' => $request->route()?->getName()]);
        try {
            $response = $next($request);
        } catch (Throwable $exception) {
            $logger->error($this->service($request), 'Request failed with exception', ['method' => $request->method(), 'route' => $request->route()?->getName(), 'exception' => $exception::class]);
            throw $exception;
        }
        $duration = (int) round((microtime(true) - $started) * 1000);
        $level = $response->getStatusCode() >= 500 ? 'error' : ($response->getStatusCode() >= 400 ? 'warning' : 'info');
        $logger->{$level}($this->service($request), 'Request completed', ['method' => $request->method(), 'route' => $request->route()?->getName(), 'status_code' => $response->getStatusCode(), 'duration_ms' => $duration]);
        $response->headers->set('X-Request-ID', $requestId);
        return $response;
    }

    private function service(Request $request): LogService
    {
        $route = strtoupper((string) $request->route()?->getName());
        foreach (LogService::cases() as $service) {
            if (str_contains($route, $service->value) || str_contains($route, strtolower($service->value))) return $service;
        }
        if (str_contains($route, 'LOGIN') || str_contains($request->path(), 'login')) return LogService::AUTH;
        if (str_contains($request->path(), 'assignment')) return LogService::ASSIGNMENT;
        if (str_contains($request->path(), 'lesson')) return LogService::LESSON;
        if (str_contains($request->path(), 'question')) return LogService::QUESTION_BANK;
        return LogService::SYSTEM;
    }
}
