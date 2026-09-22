# Manual smoke checklist

1. Log in as each seeded role and confirm the role-specific dashboard/menu.
2. As Admin, create users, course, classroom, assignment, teacher assignment, and enrollment.
3. As Teacher, verify only assigned classes; create/save/reorder/publish a lesson, create an assignment, and deliver only to the assigned class.
4. As Student, open only published lessons and an open delivery; start, refresh, autosave, submit once, and verify server time/attempt rules.
5. As Teacher, grade objective and subjective answers, enter feedback/reason, release, and verify the student sees only released grade.
6. Upload PDF, DOCX, PPTX, and TXT; inspect queue/chunks and confirm empty/scanned text becomes `NEEDS_REVIEW`.
7. Run mock AI generation, inspect evidence, edit/reject/approve; confirm no generated question is auto-published.
8. Resize to 375, 768, 1024, 1280, and 1440px; verify mobile drawer, keyboard focus, Escape dialogs, and no page overflow.
9. Attempt cross-center, unassigned-teacher, other-student, unreleased-grade, answer-key, duplicate-submit, and inactive-session access; each must be denied or rejected safely.
