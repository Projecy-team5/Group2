# Repository Guidelines

## Project Structure & Module Organization
Scholarship Hub follows the Laravel + Vite defaults. Backend code lives in `app/` (`Http/Controllers`, `Livewire/`, `Models/`, domain `Actions/`). Database definitions sit under `database/migrations` with seeds/factories mirrored in `database/seeders` and `database/factories`. UI assets live in `resources/views` (Blade), `resources/js` (entrypoints), and `resources/css`. Routes are defined in `routes/web.php` for browser traffic and `routes/api.php` for tokens. Uploads and queued exports land in `storage/`, while built assets ship out of `public/`. Tests are organized in `tests/Feature` for higher-level flows and `tests/Unit` for service logic.

## Build, Test, and Development Commands
- `composer install && npm install` - install PHP/Vite dependencies and keep lockfiles in sync.
- `php artisan migrate --seed` - apply schema changes and load starter data.
- `composer dev` - run the full local stack (HTTP server, queue worker, log tail, Vite) via `concurrently`.
- `npm run dev` - start Vite in watch mode when backend is already running.
- `npm run build` - generate production assets in `public/build`.
- `php artisan test` or `composer test` - clear config cache then run the PHPUnit suite.

## Coding Style & Naming Conventions
The repo enforces `.editorconfig` (UTF-8, LF, 4-space indents). Adhere to PSR-12 for PHP and run `./vendor/bin/pint` before committing. Name Eloquent models in singular PascalCase, Livewire components after their Blade pair (example: `Livewire/Scholarship/CreateForm.php` maps to `resources/views/livewire/scholarship/create-form.blade.php`), and use descriptive method names that express side effects. In JavaScript entrypoints use ES modules, `camelCase` helpers, and `kebab-case` Blade include names. Keep Tailwind utility groupings tidy and prefer extracting shared tokens to `tailwind.config.js`.

## Testing Guidelines
Feature tests should describe the scenario (e.g., `tests/Feature/Scholarship/ApplicationSubmissionTest.php`) and hit HTTP endpoints with assertions on database state. Unit tests in `tests/Unit` focus on pure services or value objects. Use the `RefreshDatabase` trait when touching persistence, and fake notifications/queues explicitly. Always run `php artisan test` before opening a PR; filter locally with `php artisan test --filter=ScholarshipTest` when iterating.

## Commit & Pull Request Guidelines
Recent history shows short, imperative commits ("add gallery"). Follow that tone, keep subject lines under ~72 chars, and reference tickets or GitHub issues like `[#42] add reviewer badges` when applicable. Each PR should include a summary of intent, testing evidence (`php artisan test` output or screenshots), notes about migrations or env variables, and UI captures for visible changes. Ensure the branch is rebased, CI passes, and reviewers know how to exercise the feature.

## Configuration & Security Tips
Copy `.env.example` to `.env`, set unique credentials, and never commit secrets. API keys for Google or notification providers belong in `.env` and surface through `config/*.php`. Use `php artisan config:cache`/`php artisan route:cache` after changing configs in production. Store user uploads under `storage/app` and expose them via `php artisan storage:link`; avoid placing uploads straight in `public/`.
