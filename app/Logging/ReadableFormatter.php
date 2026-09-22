<?php

namespace App\Logging;

use Monolog\Formatter\FormatterInterface;
use Monolog\LogRecord;

class ReadableFormatter implements FormatterInterface
{
    public function format(LogRecord $record): string
    {
        $context = array_merge($record->extra, $record->context);
        $role = strtoupper((string) ($context['role'] ?? 'SYSTEM'));
        $service = strtoupper((string) ($context['service'] ?? 'SYSTEM'));
        unset($context['role'], $context['service']);
        $line = sprintf('[%s] %s %s %s %s', $record->datetime->format('Y-m-d H:i:s'), $role, $service, $record->level->getName(), $record->message);

        return $line.(count($context) ? ' '.json_encode($context, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) : '').PHP_EOL;
    }

    public function formatBatch(array $records): string
    {
        return implode('', array_map(fn (LogRecord $record) => $this->format($record), $records));
    }
}
