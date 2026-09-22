# Application logging

English LMS uses `App\\Support\\Logging\\AppLogger` for application events. Logs are human-readable by default:

```text
[2026-09-12 12:22:15] TEACHER LESSON INFO Lesson updated {"request_id":"req_...","user_id":15}
```

Channels rotate daily and are stored under `storage/logs/`: `auth`, `assignment`, `lesson`, `question-bank`, `ai`, `import`, `submission`, `grading`, `queue`, `integration`, and `error`.

Request IDs are accepted from a safe `X-Request-ID` header or generated automatically, then returned in the response header. Use them to trace a complete request across channels.

```bash
grep 'ASSIGNMENT' storage/logs/assignment/*.log
grep 'ERROR' storage/logs/error/*.log
grep 'req_01' storage/logs/**/*.log
```

Use the logger in application code:

```php
app(AppLogger::class)->info(LogService::ASSIGNMENT, 'Assignment published', ['assignment_id' => $assignment->id]);
```

Never log passwords, tokens, cookies, session IDs, API keys, authorization headers, raw documents, answers, or full request payloads. The logger recursively redacts sensitive keys and never lets a logging failure break a business transaction.

Retention and levels are configured with `LOG_LEVEL`, `LOG_*_DAYS`, and `LOG_ERROR_LEVEL` in `.env`.
