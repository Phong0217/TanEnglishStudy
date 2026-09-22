# RBAC and data scope

Spatie Permission seeds exactly three roles. Admin permissions are center-wide. Teacher permissions are still constrained by active `classroom_teachers` and course-version ancestry. Student permissions are constrained by active `enrollments` and submission/grade ownership.

| Capability | Admin | Teacher (assigned class) | Student (own active enrollment) |
|---|---:|---:|---:|
| Manage accounts/roles | Yes | No | No |
| Curriculum authoring | Yes | Own/permitted lessons | No |
| Deliver assignments | Any center class | Assigned class | No |
| Grade/release | Any center submission | Assigned class | No |
| Question/document/AI tools | Center | Permitted scope | No |
| Released grades | Any | Assigned class | Own only |
| Audit logs/settings | Yes | No | No |

Backend checks remain effective when a user changes a URL or submits a different ID. The only active administrator cannot deactivate their own account.
