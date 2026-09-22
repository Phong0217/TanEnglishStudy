# Architecture

The application is a modular monolith. HTTP controllers are thin and delegate business rules to domain actions/services. Form Requests validate input, policies authorize parent and child resources, Eloquent models express relationships, and Inertia serializes page-specific props. JSON endpoints are limited to autosave, attempts, job status, and background interactions.

```mermaid
flowchart LR
  Browser[React + Inertia] --> Routes[Laravel routes]
  Routes --> Policies[Policies + role middleware]
  Policies --> Actions[Domain actions/services]
  Actions --> DB[(MySQL)]
  Actions --> Queue[Redis queue]
  Queue --> Parser[PDF/DOCX/PPTX/TXT parser]
  Queue --> AI[AI provider abstraction]
  Actions --> Files[Private filesystem / S3]
```

Direct center-owned models use the `BelongsToCenter` scope. Indirect resources are constrained through their parent relation in policies and query builders. Student and teacher paths never trust client ownership IDs. Assignment items are snapshots; submissions and grades are persisted independently of later lesson/question edits.
