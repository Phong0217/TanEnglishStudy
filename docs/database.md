# Database

The greenfield migrations create centers, users/profiles, curriculum hierarchy, private media/documents/chunks, question and assignment versioning, classrooms/enrollments, immutable delivery items, submissions/answers/grades/audits, progress, notifications, and audit logs, plus Spatie's permission tables.

Operational timestamps are UTC; a center timezone is stored for display conversion. Historical records use soft deletes/status transitions. JSON is limited to flexible block/question content, answer keys, settings, rubrics, parser metadata, and audit old/new values.

The assessment chain is `assignment_versions -> assignment_items -> submissions -> submission_answers -> grades`; assignment items keep snapshots so later lesson/question edits cannot alter an attempt.
