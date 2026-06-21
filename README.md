# Axion

> Modern modular service management system for repair, maintenance, and technical service companies.

Axion centralizes business operations — from customer management and service orders to inventory and document generation — replacing paper-based processes with a clean, digital workflow. It is built to be adaptable across multiple service segments, not tied to any single niche.

---

## Vision

Axion aims to become the standard open-source platform for service business management. The core philosophy is **generality without compromise**: the system must serve a locksmith as well as it serves an electronics repair shop or an automotive workshop. Every feature should be designed with adaptability in mind, so that the same codebase can power vastly different service businesses through configuration, not forks.

---

## Features

- **Dashboard** — Real-time overview of business metrics
- **Customers** — Full CRM with service history
- **Equipment / Assets** — Track customer assets, serial numbers, and warranty
- **Service Orders** — Create, assign, track, and close service orders
- **Services** — Define and manage service catalogs with pricing
- **Products** — Product catalog with cost/price management
- **Sales** — Point-of-sale and invoice generation
- **Inventory** — Stock control, movements, and alerts
- **Documents** — Service Orders, Estimates, Receipts, Warranty Certificates, Technical Reports
- **Custom Checklists** — Configurable checklists per service type
- **Custom Fields** — Dynamic fields attached to any entity
- **Attachments** — File uploads linked to orders, customers, equipment
- **Reports** — Financial, operational, and productivity reports
- **Company Settings** — Multi-tenant ready configuration

---

## Technology Stack

| Layer | Technology |
|-------|-----------|
| Backend | PHP 8.4, Laravel 13 |
| Frontend | Vue 3, Inertia.js 3, TypeScript |
| Styling | Tailwind CSS 4 |
| Build | Vite 8 |
| Database | MySQL (SQLite for development) |
| Auth | Laravel built-in |
| Authorization | Spatie Laravel Permission |
| Testing | Pest 4, PHPStan (level 7) |
| Code Quality | Laravel Pint, ESLint, Prettier, vue-tsc |
| Routing | Laravel Wayfinder (typed routes) |

---

## Folder Structure

```
├── app/
│   ├── Http/
│   │   ├── Controllers/        # Feature-based controllers
│   │   └── Middleware/
│   ├── Models/                  # Eloquent models
│   └── Providers/               # Service providers
├── bootstrap/
├── config/
├── database/
│   ├── factories/
│   ├── migrations/
│   └── seeders/
├── resources/
│   ├── css/
│   ├── js/
│   │   ├── actions/             # API/Inertia action helpers
│   │   ├── lib/                 # Utility functions
│   │   ├── pages/               # Page components
│   │   ├── routes/              # Typed route definitions
│   │   ├── types/               # TypeScript type definitions
│   │   └── app.ts               # Application entry
│   └── views/
├── routes/
│   ├── web.php
│   └── console.php
├── tests/
│   ├── Feature/
│   └── Unit/
└── ...config files
```

> **Note:** As modules are implemented, each module will be organized within `app/` following a domain-based structure (see _Architecture Decisions_).

---

## Architecture Decisions

### 1. Clean Architecture with Modular Domains

The application is organized into **domain modules** rather than technical layers. Each module (e.g., `Customers`, `ServiceOrders`, `Inventory`) contains its own:

- Controller
- Request/Validation rules
- Action classes (for business logic)
- Model (with scopes, relationships, casts)
- Policies
- Tests

```php
app/
├── Modules/
│   ├── Customers/
│   │   ├── Controllers/
│   │   ├── Actions/
│   │   ├── Models/
│   │   ├── Policies/
│   │   └── Requests/
│   ├── ServiceOrders/
│   └── ...
```

This keeps the codebase navigable, scalable, and prevents circular dependencies.

### 2. Actions Over Services

Business logic lives in **single-action classes** (invokable or named methods) rather than bloated service classes. This follows the _Action Pattern_ popularized by Laravel and keeps operations testable and composable.

### 3. Inertia.js Monolith

All rendering is server-driven via Inertia.js. There is no separate API layer for the frontend. Data is passed as props from controllers to Vue page components. This avoids the overhead of maintaining a REST/GraphQL layer for a single-page application.

### 4. Strong Typing

- PHP: Strict types, typed properties, PHPStan level 7
- TypeScript: Strict mode, no implicit any, typed routes via Wayfinder

### 5. Permissions via Spatie

All authorization flows through `Spatie\Permission`. Permissions are defined per module and assigned to roles. No ad-hoc gate checks. See _How Permissions Should Be Implemented_ below.

### 6. Database First, But Not Driven

The schema drives the application, but business logic is never coupled to database structure. Repositories are not used — Eloquent is sufficient — but queries are encapsulated in **scopes** and **action classes**.

### 7. Tailwind CSS as the Single Source of Styling

No CSS modules, no styled-components, no Sass. All styling is done with Tailwind utility classes. The `cn()` helper (`clsx` + `tailwind-merge`) is used for conditional classes.

---

## Coding Standards

### PHP

- PSR-12 coding style (enforced by Laravel Pint)
- Strict type declarations (`declare(strict_types=1)`)
- Typed properties on all models and DTOs
- No docblocks for typed properties (use native types instead)
- Named arguments for long parameter lists
- Readonly properties where applicable
- PHPStan level 7 — no exceptions

### TypeScript / Vue

- `strict: true` in tsconfig
- `defineProps` and `defineEmits` with typed generics
- No `any` — prefer `unknown`
- `script setup` syntax (Composition API)
- Single-word component names prefixed with module (e.g., `CustomerList`, `ServiceOrderForm`)
- Types defined in `types/` directory or co-located with component

### General

- No commented-out code
- No `dd()` or `dump()` in committed code
- Descriptive variable names — no abbreviations

---

## Development Workflow

```bash
# Start development server
composer dev

# Run all checks before committing
composer test          # lint + phpstan + pest
npm run lint:check     # ESLint
npm run format:check   # Prettier
npm run types:check    # vue-tsc
```

### Available Commands

| Command | Description |
|---------|-------------|
| `composer dev` | Start dev server, queue, logs, and Vite |
| `composer lint` | Fix PHP code style with Pint |
| `composer lint:check` | Check PHP code style |
| `composer types:check` | PHPStan analysis |
| `composer test` | Run full CI pipeline locally |
| `npm run dev` | Start Vite dev server |
| `npm run build` | Build for production |
| `npm run lint` | Fix frontend with ESLint |
| `npm run format` | Format with Prettier |
| `npm run types:check` | vue-tsc type check |

### Continuous Integration

Two GitHub Actions workflows run on push/PR to `develop`, `main`, `master`:

- **tests.yml** — PHP 8.3, 8.4, 8.5 matrix; composer install, build, PHPStan, Pest
- **lint.yml** — Pint, Prettier, ESLint

---

## Installation

```bash
# Clone the repository
git clone https://github.com/your-org/axion.git
cd axion

# Install PHP dependencies
composer install

# Install Node dependencies
npm install

# Environment setup
cp .env.example .env
php artisan key:generate

# Database (SQLite for development)
touch database/database.sqlite
php artisan migrate

# Build assets
npm run build

# Start development
composer dev
```

### Using MySQL (Production)

```bash
# Edit .env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=axion
DB_USERNAME=root
DB_PASSWORD=yourpassword

php artisan migrate
```

---

## Environment Setup

Key environment variables:

```
APP_NAME=Axion
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=sqlite       # sqlite or mysql

SESSION_DRIVER=database
SESSION_LIFETIME=120

QUEUE_CONNECTION=database
CACHE_STORE=database
```

The `.env.example` file contains the full list of available variables.

---

## Commit Convention

This project follows the [Conventional Commits](https://www.conventionalcommits.org/) specification:

```
<type>(<scope>): <description>
```

Types:

| Type | Usage |
|------|-------|
| `feat` | New feature |
| `fix` | Bug fix |
| `refactor` | Code change that neither fixes a bug nor adds a feature |
| `style` | Code style changes (formatting, Pint, Prettier) |
| `test` | Adding or fixing tests |
| `docs` | Documentation changes |
| `chore` | Build, config, dependencies |
| `perf` | Performance improvement |

Examples:

```
feat(customers): add customer search by phone
fix(orders): prevent duplicate order numbers on retry
refactor(modules): extract shared checklist logic
test(inventory): add stock movement tests
```

---

## Roadmap

### Phase 1 — Foundation

- [x] Laravel 13 + Vue 3 + Inertia.js scaffold
- [x] TypeScript + Tailwind CSS 4 setup
- [x] CI pipeline with Pest, PHPStan, Pint, ESLint, Prettier
- [ ] Authentication (register, login, password reset)
- [ ] User roles and permissions (Spatie)
- [ ] Company settings module
- [ ] Dashboard

### Phase 2 — Core Modules

- [ ] Customers (CRM with service history)
- [ ] Equipment / Assets
- [ ] Service Orders
- [ ] Services catalog
- [ ] Products catalog
- [ ] Inventory management

### Phase 3 — Business Operations

- [ ] Sales (POS)
- [ ] Documents engine (Service Orders, Estimates, Receipts, Warranty, Technical Reports)
- [ ] Custom checklists
- [ ] Custom fields
- [ ] Attachments

### Phase 4 — Advanced

- [ ] Reports and analytics
- [ ] Notifications (email, in-app)
- [ ] Audit logging
- [ ] Multi-tenant support
- [ ] API (for integrations)
- [ ] Import/export (CSV, PDF)
- [ ] Email templates

---

## Future Features

- **Mobile app** (PWA or native)
- **Calendar / scheduling** for service appointments
- **Payment gateway integration**
- **SMS notifications**
- **Barcode / QR code scanning**
- **POS hardware integration** (receipt printers, barcode scanners)
- **E-commerce product catalog**
- **Multi-language support** (i18n)
- **Third-party integrations** (accounting, ERP)
- **Offline mode**

---

## Contribution Guide

1. Fork the repository
2. Create a feature branch (`feat/my-feature` or `fix/my-bug`)
3. Write tests for your changes
4. Ensure all checks pass: `composer test`
5. Run frontend checks: `npm run lint:check` and `npm run types:check`
6. Submit a pull request

All contributions must follow the coding standards and commit convention defined in this document.

---

## License

Axion is open-source software licensed under the [MIT license](LICENSE).

---

## AI Context

> This section is intended for AI assistants and future developers to understand the project's philosophy, constraints, and patterns so that contributions remain consistent with the original design.

### Purpose

Axion is a **modular service management platform** for businesses that perform repair, maintenance, or technical services. The defining requirement is **business segment agnosticism**: the same system should be usable by an auto repair shop, a computer repair technician, a shoe repair store, a locksmith, or a metal workshop — without code changes. All differentiation must come from configuration (custom fields, checklists, service catalogs, document templates).

### Inviolable Architecture Rules

1. **No hard-coded business logic for a specific segment.** Never write code that assumes a particular industry. Use configuration, custom fields, and polymorphic relationships instead.
2. **Every module must be self-contained.** A module has its own controllers, actions, models, policies, requests, and tests. Cross-module communication happens through explicit interfaces — never by reaching into another module's internals.
3. **Business logic lives in Action classes.** Controllers must be thin — they validate the request, call an action, and return an Inertia response. Actions are invokable or expose named methods. Actions accept models/values and return results or throw exceptions.
4. **Permissions must use Spatie.** Every module registers its permissions (e.g., `customers.create`, `orders.update.status`). Policies reference these permissions. Never use ad-hoc `Gate::define` or inline `if (admin)` checks.
5. **No separate API layer.** Axion is an Inertia monolith. If an API is needed later, it will be a separate concern. Do not build API controllers alongside Inertia controllers.

### Coding Standards (Must Follow)

- PHP: `declare(strict_types=1)`, typed properties, PSR-12
- TypeScript: `strict: true`, no `any`, typed props/emits
- Vue: `<script setup lang="ts">`, Composition API
- Tests: Pest, feature tests for HTTP layer, unit tests for actions
- No commented code, no debug dump calls

### Laravel Patterns (Preferred)

- **Models**: Use `#[Fillable]`, `#[Hidden]`, `#[Cast]` attributes (PHP 8.4 style). Define relationships, scopes, and custom accessors/mutators. Avoid giant models — extract query logic to scopes, business logic to actions.
- **Migrations**: Always `down` method present. Column names are `snake_case`. Foreign keys are constrained.
- **Validation**: Form Request objects per action, never inline validation in controllers.
- **Routes**: `Route::resource` for CRUD, explicit routes for custom actions. All routes named.
- **Wayfinder**: Use `@see` annotations in route files for Wayfinder typed routes.

### Vue Component Organization

```
resources/js/
├── pages/                     # Page-level components (one per route)
│   ├── Customers/
│   │   ├── Index.vue
│   │   ├── Create.vue
│   │   ├── Edit.vue
│   │   └── Show.vue
│   └── ...
├── lib/                       # Pure utility functions
│   └── utils.ts               # cn() and other helpers
├── types/                     # Global TypeScript types
│   ├── auth.ts
│   └── index.ts
├── actions/                   # Inertia action helpers
├── routes/                    # Wayfinder-generated typed routes
└── app.ts
```

- Page components receive Inertia props and orchestrate UI
- No `defineComponent` wrapper — use `<script setup>` only
- Conditional classes use the `cn()` utility from `lib/utils.ts`

### Naming Conventions

- **PHP classes**: PascalCase (`CreateCustomer`, `ServiceOrderController`)
- **PHP methods**: camelCase (`store`, `updateStatus`)
- **PHP variables/properties**: camelCase (`$serviceOrder`, `$customerName`)
- **Database columns**: snake_case (`service_order_id`, `created_at`)
- **TypeScript types/interfaces**: PascalCase (`Customer`, `ServiceOrder`)
- **TypeScript variables**: camelCase
- **Vue components**: PascalCase, component name matches filename
- **Vue files**: One component per file, named after the component

### File Organization

```
Module structure:
app/Modules/{Module}/
├── Controllers/{Module}Controller.php    # or multiple controllers
├── Actions/{Action}.php                  # single-action classes
├── Models/{Model}.php
├── Policies/{Model}Policy.php
├── Requests/{Request}.php
└── tests/                                # co-located or in tests/
```

If a module is small enough, its controllers, actions, and models may live at the `app/` level without a `Modules/` directory wrapper. The structure should be chosen pragmatically — if a module grows beyond ~5 files, extract it to `Modules/`.

### How New Modules Should Be Created

1. Create the migration
2. Create the Model with fillable attributes, casts, relationships
3. Create the Controller (resourceful or explicit)
4. Create Action classes for business operations
5. Create Form Requests for validation
6. Create the Policy with Spatie permission checks
7. Register permissions in a seeder
8. Create Blade or Inertia page components in `resources/js/pages/{Module}/`
9. Write tests (Pest)
10. Register routes

### How Permissions Should Be Implemented

```php
// In a seeder
use Spatie\Permission\Models\Permission;

Permission::create(['name' => 'customers.create']);
Permission::create(['name' => 'customers.view']);
Permission::create(['name' => 'customers.update']);
Permission::create(['name' => 'customers.delete']);

// In a Policy
class CustomerPolicy
{
    public function view(User $user): bool
    {
        return $user->hasPermissionTo('customers.view');
    }

    public function create(User $user): bool
    {
        return $user->hasPermissionTo('customers.create');
    }
}
```

- Permissions are named `{module}.{action}` in kebab-case
- Roles are assigned in seeders or via UI
- Policies are registered in `AuthServiceProvider`
- Never check permissions anywhere other than Policies

### Philosophy

The system must remain **generic and adaptable**. Every design decision should be evaluated against the question: *"Will this still work if the business is a shoe repair shop instead of an electronics repair shop?"*

This means:
- Avoid hard-coded enums for business-specific values — use database-driven config
- Avoid assumptions about workflows — use checklists and statuses that users configure
- Avoid domain-specific terminology in core code — keep it generic (e.g., "equipment" not "device" or "vehicle")
- Prefer polymorphic relationships over separate tables for similar entities
- Custom fields should be attachable to any entity type
- Document templates should be configurable per business segment

If a feature cannot be made generic, it should be built as a pluggable module that can be enabled/disabled per installation, rather than hard-wired into the core.
