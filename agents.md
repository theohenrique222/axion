# Axion — Architecture & AI Behavior Guide

> **Ultimate reference for code quality, clean architecture, and strict consistency across the entire codebase.**

---

## Project Context

Axion is a modular, scalable service management system for technical assistance businesses (repair shops, workshops, maintenance companies, etc). It must remain **fully generic**, not tied to any specific industry.

The system must support both:

- **SaaS** — MySQL / PostgreSQL
- **Desktop** — NativePHP with SQLite

---

## Technology Stack

| Layer | Technology |
|---|---|
| Backend | Latest Laravel |
| Frontend | Vue 3 + Inertia.js |
| Language | TypeScript (mandatory) |
| Styling | Tailwind CSS |
| Build | Vite |
| Databases | SQLite (desktop), MySQL / PostgreSQL (SaaS) |
| Testing | Pest |
| Auth/Permissions | Spatie Laravel Permission |

---

## 1. Architecture Rules (VERY STRICT)

- The project must follow **Clean Architecture principles adapted to Laravel**.
- Controllers **MUST be thin** and only handle HTTP layer concerns.
- Business logic **MUST** be moved to **Actions** or **Services**.
- Queries **SHOULD** be isolated when necessary (Query classes or repository-like pattern).
- **No business logic** inside:
  - Controllers
  - Form Requests
  - Views
- Modules must be fully independent under `Modules/`.

---

## 2. Code Organization Pattern (MANDATORY)

Each feature/module must follow this structure:

```
Modules/{Module}/
├── Actions/
├── Controllers/
├── DTOs/
├── Policies/
├── Requests/
├── Resources/
├── Services/
├── Models/
└── ...
```

**Flow:**

```
Controller → Action → Service (optional) → Model
```

| Layer | Responsibility |
|---|---|
| Controllers | Request/response handling only |
| Actions | Single-responsibility business operations |
| Services | Shared business logic when needed |
| DTOs | Data transfer objects when necessary |
| Requests | Validation only |
| Policies | Authorization rules |
| Resources | API / data transformation |

Controllers must call Actions directly.

---

## 3. Frontend Rules (Vue 3)

- **Composition API only** — no Options API.
- **TypeScript is mandatory** in all components.
- Components must be reusable and modular.
- No duplicated UI logic allowed.
- **Business logic must NOT exist in components** — delegate to composables, stores, or API calls.
- State management must be clean and minimal.

---

## 4. Database Rules

- Must support **SQLite** (NativePHP desktop) and **MySQL / PostgreSQL** (SaaS).
- **No database vendor-specific features** allowed.
- Migrations must be fully portable across all supported engines.
- **Always prefer Eloquent** over raw SQL.
- Avoid complex SQL queries unless absolutely necessary.

---

## 5. Permissions & Security

- Use **Spatie Laravel Permission**.
- Every module **MUST** define its permissions explicitly.
- Authorization **MUST** be enforced in Policies and Controllers.
- **No frontend-only security assumptions** — always enforce on the server.

---

## 6. Testing Rules

- **Pest** is the primary testing framework.
- Feature tests > Unit tests.
- Every Action **SHOULD** be testable in isolation.
- Critical flows **must** always have tests (auth, orders, permissions, etc).

---

## 7. AI Behavior Rules (CRITICAL)

Any AI or developer working in this project **MUST**:

- Follow existing architecture strictly.
- **Never** introduce new patterns without explicit approval.
- **Never** bypass Actions / Controllers separation.
- Always reuse existing modules and logic when possible.
- Prefer **consistency** over personal preference.
- **Never** add shortcuts or "quick fixes".
- Maintain clean, scalable, production-grade code.

---

## 8. Project Philosophy

- The system must remain **generic and multi-business**.
- It must be **scalable to SaaS and Desktop (NativePHP)**.
- Code must be **clean, explicit, and maintainable**.
- Every decision must favor **long-term scalability** over short-term speed.
- The project is treated as a **production-grade SaaS product**.

---

## Final Rule

> If a solution violates architecture consistency, it is considered **incorrect**, even if it works.
