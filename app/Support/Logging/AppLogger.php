<?php

namespace App\Support\Logging;

use App\Enums\LogService;
use Illuminate\Support\Facades\Log;
use Throwable;

class AppLogger
{
    private const SENSITIVE = ['password', 'password_confirmation', 'token', 'access_token', 'refresh_token', 'authorization', 'cookie', 'session_id', 'otp', 'api_key', 'api_secret', 'secret', 'database_password'];

    public function debug(LogService|string $service, string $message, array $context = []): void { $this->write('debug', $service, $message, $context); }
    public function info(LogService|string $service, string $message, array $context = []): void { $this->write('info', $service, $message, $context); }
    public function notice(LogService|string $service, string $message, array $context = []): void { $this->write('notice', $service, $message, $context); }
    public function warning(LogService|string $service, string $message, array $context = []): void { $this->write('warning', $service, $message, $context); }
    public function error(LogService|string $service, string $message, array $context = []): void { $this->write('error', $service, $message, $context); }
    public function critical(LogService|string $service, string $message, array $context = []): void { $this->write('critical', $service, $message, $context); }

    private function write(string $level, LogService|string $service, string $message, array $context): void
    {
        try {
            $name = $service instanceof LogService ? $service->value : strtoupper($service);
            $channel = config('logging.service_channels.'.$name, 'application');
            $base = ['role' => $this->role(), 'service' => $name, 'request_id' => request()?->attributes->get('request_id'), 'user_id' => auth()->id(), 'environment' => app()->environment()];
            Log::channel($channel)->{$level}($message, $this->sanitize(array_merge($base, $context)));
            if (in_array($level, ['error', 'critical'], true) && $channel !== 'error') {
                Log::channel('error')->{$level}($message, $this->sanitize(array_merge($base, $context)));
            }
        } catch (Throwable) {
            // Logging must never break the business operation being observed.
        }
    }

    private function role(): string
    {
        if (! auth()->check()) return 'GUEST';
        return strtoupper((string) (auth()->user()->getRoleNames()->first() ?: 'SYSTEM'));
    }

    private function sanitize(array $values): array
    {
        $result = [];
        foreach ($values as $key => $value) {
            $normalized = strtolower((string) $key);
            if (in_array($normalized, self::SENSITIVE, true) || str_contains($normalized, 'password') || str_contains($normalized, 'token')) {
                $result[$key] = '[REDACTED]';
            } elseif (is_array($value)) {
                $result[$key] = $this->sanitize($value);
            } elseif (is_scalar($value) || $value === null) {
                $result[$key] = $value;
            } else {
                $result[$key] = get_debug_type($value);
            }
        }
        return $result;
    }
}
