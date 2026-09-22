# Implementation progress

## 2026-09-05

- Bootstrapped Laravel 12.69 with Breeze React/TypeScript, Inertia, Vite, Tailwind, Spatie Permission, Redis, S3 adapter, PDF/DOCX/PPTX parsers, dnd-kit, TipTap, charts, Zod, and Vitest dependencies.
- Added MySQL-ready schema for centers, users/profiles, curriculum, lesson blocks, classrooms/enrollments, question/assignment versioning, immutable snapshots, submissions, grading/audits, progress, documents, AI jobs, notifications, and audit logs.
- Added center-aware models, relationships, enums, permissions, seed data, active-user middleware, admin command, policies, validation requests, audit logger, grading/submission/assignment actions, parser job, AI abstraction/mock/OpenAI adapter, and route groups.
- Added working admin/teacher/student dashboards, CRUD foundation screens, lesson builder with dnd-kit/autosave/conflict handling, assignment player/autosave/timer/submit flow, grade review/release screens, question/document/AI/report/audit/notification screens, responsive AppShell, accessibility states, and shared design tokens/components.
- Verified `php artisan about`, `php artisan route:list` (93 routes), MySQL `migrate:fresh --seed` (13 users, 2 classrooms, 2 notifications), `php artisan test` (25 tests / 57 assertions passed), `vendor/bin/pint --test`, `npm run lint`, `npm run type-check`, `npm run test` (2 tests), and `npm run build`.
- Added Vitest/jsdom setup, ESLint flat configuration, PHPStan/Larastan configuration, and GitHub Actions CI workflow.
- UI refinement pass: introduced shared Button API with primary, secondary, outline, ghost, danger, icon, size, loading, and full-width states; refreshed shared page headers, badges, cards, empty states, pagination, fields, dialogs, tables, student answer options, responsive spacing, and reduced-motion tokens. Existing AppShell and auth buttons now use the shared visual language.
- Added `lesson_versions` migration/model with draft and published version pointers, linked existing lesson blocks during migration, and made builder saves/publish and student playback version-aware. Verified the migration on the existing local MySQL database and reran the backend suite (25 tests / 57 assertions passed).
- Advanced editor pass: replaced the generic JSON-only properties panel with type-aware editors for all registered content, media and question blocks; added shared list editing, answer-key controls, points/required/grading settings, duplicate/delete actions, autosave conflict preservation, and a draft Student Preview route that reuses the Student renderer.
- AI English Question Generator pass: added center/course-version scoped PDF/DOCX import, signature and duplicate checks, semantic Unit/Lesson/section chunk metadata, English-only prompt constraints, deterministic blueprint validation, bounded batch generation with missing-slot retries, evidence validation, duplicate detection, IN_REVIEW drafts, source-aware review/edit/regenerate endpoints, bulk review actions, and a functional generator/review UI. Added migration `2026_09_07_000001_extend_english_question_generation` for job progress/idempotency and Question English metadata.
- Added a guarded `Approve all` workflow to AI generation review pages. It counts and submits only DRAFT/IN_REVIEW questions from the current scoped job, preserves rejected decisions, requires an explicit confirmation step, exposes loading state, and refreshes canonical statuses and accepted counts through the existing transactional bulk endpoint.
- Replaced the ephemeral local MySQL process convention with a Docker-first runtime. Compose now builds and runs Laravel, queue and scheduler processes; persists MySQL, Redis, MinIO and private application storage in named volumes; maps host MySQL `3307` consistently to container `3306`; creates an isolated MySQL test database; and provides safe start, stop and test scripts that preserve volumes by default.

## Current scope notes

- Core end-to-end authentication, role scoping, curriculum, lesson builder, assignment snapshots, student submission, grading, documents, AI queue abstraction, notifications, reports, and audit foundations are implemented.
- Bulk CSV import, scheduled due-soon notification automation, and browser-level Playwright coverage remain follow-up work. The Lesson Builder now includes a per-type editing surface for content, media, language, reading/listening and question blocks, with shared list editors, answer-key editing, duplicate/delete controls, autosave and conflict handling.
- PHPStan currently reports existing dynamic Eloquent typing issues (143 findings at level 5); it is configured for follow-up and is not claimed as passing. The failure is unrelated to Docker startup.

## Environment note

This environment has no SQLite driver and sandboxed processes cannot bind local sockets, so database verification used an isolated MySQL 8 instance on port 3307 and an explicit test database. Docker Compose is supplied for reproducible local services.

- Queue and scheduler entrypoints wait for the database-backed cache migration, preventing a first-boot race while migrations are running. `scripts/docker-test.sh` runs the development PHPUnit suite inside the PHP container against the isolated test database.
- Core frontend navigation, authentication, dashboards, lesson builder, documents, assignments, grading, notifications, student pages, and AI question-generation screens now use Vietnamese system labels while preserving English content entered by users.
## Frontend UX/UI refactor

- Chuẩn hóa Button, Badge, Pagination và trạng thái loading bằng tiếng Việt.
- Nâng cấp AppShell theo role, bổ sung không gian học tập riêng cho Student.
- Cải thiện Student Dashboard, danh sách lớp, bài học, bài tập và điểm số theo hướng mobile-first.
- Không thay đổi backend, route, API contract, payload hoặc quyền truy cập.
- Đã chạy type-check, lint, frontend tests và production build thành công.
