<?php

namespace App\Domain\Audit;

use App\Models\AuditLog;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Throwable;

class AuditLogger
{
    private const SENSITIVE = ['password', 'remember_token', 'token', 'api_key', 'secret'];

    public function record(string $action, Model $entity, ?array $old = null, ?array $new = null, ?string $reason = null): void
    {
        try {
            AuditLog::withoutGlobalScopes()->create([
                'center_id' => auth()->user()?->center_id ?? $entity->center_id,
                'actor_id' => auth()->id(), 'action' => $action,
                'entity_type' => $entity->getMorphClass(), 'entity_id' => $entity->getKey(),
                'old_values_json' => $this->sanitize($old), 'new_values_json' => $this->sanitize($new),
                'reason' => $reason, 'ip_address' => request()?->ip(),
                'user_agent' => mb_substr((string) request()?->userAgent(), 0, 1000),
            ]);
        } catch (Throwable $exception) {
            report($exception);
        }
    }

    private function sanitize(?array $values): ?array
    {
        return $values === null ? null : Arr::except($values, self::SENSITIVE);
    }
}
