# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

Scholarship Hub is a Laravel 12 application for managing scholarship applications. It features:
- Public-facing frontend for browsing scholarships and articles
- Admin dashboard for managing scholarships, users, articles, and applications
- Role-based access control (RBAC) with admin privileges
- Google Gemini AI chatbot integration
- Laravel Jetstream authentication with Livewire

## Development Commands

### Starting Development Environment
```bash
# Start all services (server, queue, logs, vite) concurrently
composer dev

# Or start services individually:
php artisan serve              # Development server
php artisan queue:listen       # Queue worker
php artisan pail              # Real-time logs
npm run dev                   # Vite asset compilation
```

### Database Operations
```bash
# Run migrations
php artisan migrate

# Seed database (creates admin user and roles)
php artisan db:seed

# Fresh migration with seeding
php artisan migrate:fresh --seed
```

### Testing
```bash
# Run all tests
composer test
# Or: php artisan test

# Run specific test suite
php artisan test --testsuite=Feature
php artisan test --testsuite=Unit

# Run single test file
php artisan test tests/Feature/ExampleTest.php
```

### Code Quality
```bash
# Format code with Laravel Pint
./vendor/bin/pint

# View logs in real-time
php artisan pail --timeout=0
```

### Asset Building
```bash
npm run dev    # Development with hot reload
npm run build  # Production build
```

## Architecture

### Authentication & Authorization

**User Roles**: Implemented via `Role` model with `is_admin` flag
- Admin detection: `User::isAdmin()` checks `$user->role->is_admin`
- Middleware: `AdminMiddleware` protects admin routes (routes/web.php:67)
- Default admin: `admin@gmail.com` / `password` (seeded in DatabaseSeeder)

**Auth Stack**: Laravel Jetstream + Livewire + Sanctum
- Two-factor authentication supported
- Email verification available
- Profile photo management included

### Route Structure

**Frontend Routes** (public):
- `/` - Home
- `/scholarships` - Scholarship listing and detail
- `/articles` - Article listing (by slug)
- `/articles/{slug}` - Single article
- `/category/{slug}` - Articles by category
- `/chatbot` - Google Gemini AI chat endpoint

**Authenticated User Routes**:
- `/dashboard` - User dashboard (auto-redirects admins to admin dashboard)
- `/scholarships/{scholarship}/apply` - Apply to scholarship

**Admin Routes** (`/admin/*` with `auth` + `admin` middleware):
- `/admin/dashboard` - Admin dashboard
- `/admin/scholarships` - Scholarship CRUD
- `/admin/users` - User management
- `/admin/articles` - Article CRUD
- `/admin/categories` - Category CRUD
- `/admin/roles` - Role management
- `/admin/applications` - View all applications

### Key Models & Relationships

**User** (app/Models/User.php)
- `belongsTo(Role)` - Single role per user
- `hasMany(Application)` - User's scholarship applications
- `isAdmin()` method checks role's `is_admin` flag
- Uses Jetstream traits: `HasProfilePhoto`, `TwoFactorAuthenticatable`

**Scholarship** (app/Models/Scholarship.php)
- `hasMany(ScholarshipImage)` - Multiple images per scholarship
- `application_requirements` casted to array
- Fields: scholarship_name, award_amount, country, eligibility_criteria, application_description, application_deadline, status

**Application** (app/Models/Application.php)
- `belongsTo(User)` - Applicant
- `belongsTo(Scholarship)` - Applied scholarship
- Fields: motivation_essay, resume, phone, address, status

**Article** (app/Models/Article.php)
- `belongsToMany(Category)` - Many-to-many with categories
- Auto-generates unique slugs from title on create/update
- `scopePublished()` - Query scope for published articles only
- Route key: slug (not ID)

**Role** (app/Models/Role.php)
- `hasMany(User)` - Users with this role
- `is_admin` boolean flag determines admin access
- Fields: name, slug, description

### Controller Namespace Distinction

**Important**: Articles have TWO controllers:
- `App\Http\Controllers\Frontend\ArticleController` - Public article views
- `App\Http\Controllers\Admin\ArticleController` - Admin CRUD (aliased in routes)

Always check the namespace when working with ArticleController to avoid confusion.

### Database

**Connection**: SQLite (default)
- Database file: `database/database.sqlite`
- Queue/cache use database driver
- Session stored in database

**Seeders**: `DatabaseSeeder` calls `RoleSeeder` then creates admin user with admin role

### Frontend Stack

**Views**: Blade templates organized by area
- `resources/views/frontend/*` - Public pages
- `resources/views/admin/*` - Admin dashboard pages
- `resources/views/layouts/dashboard.blade.php` - Admin layout
- Livewire components for reactive features

**Assets**: Vite + Tailwind CSS 3
- Tailwind plugins: @tailwindcss/forms, @tailwindcss/typography
- Entry point: `resources/css/app.css`

**UI Libraries**:
- SweetAlert (via php-flasher/flasher-sweetalert-laravel) for flash messages
- Livewire for dynamic components

### Third-Party Integrations

**Google Gemini AI**: Chatbot functionality
- Endpoint: `POST /chatbot` (GeminiController)
- Requires `GOOGLE_API_KEY` in .env

**Eloquent Sluggable**: Auto-slug generation (cviebrock/eloquent-sluggable)

## Important Notes

- User model eager loads `role` relationship (`protected $with = ['role']`)
- Articles auto-generate slugs from title - don't manually set slugs
- Admin access requires both authentication AND role with `is_admin = true`
- The `composer dev` script runs 4 concurrent processes (server, queue, logs, vite) - useful for full dev environment
- When creating migrations, follow the timestamp format: `YYYY_MM_DD_HHMMSS_description.php`
