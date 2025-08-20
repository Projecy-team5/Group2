# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Development Commands

### Development Environment
- `composer dev` - Start the full development environment (Laravel server, queue worker, logs, and Vite dev server)
- `php artisan serve` - Start Laravel development server only
- `npm run dev` - Start Vite dev server for asset compilation
- `npm run build` - Build production assets

### Testing
- `composer test` - Run the full test suite (clears config and runs PHPUnit)
- `php artisan test` - Run tests directly
- `php artisan test --filter TestName` - Run specific test

### Code Quality
- Uses Laravel Pint for code formatting (included in composer.json dev dependencies)
- PHPUnit configured for testing with in-memory SQLite database

### Database
- `php artisan migrate` - Run database migrations
- `php artisan migrate:fresh --seed` - Fresh migration with seeding
- Uses SQLite by default (see .env.example)

## Architecture Overview

### Tech Stack
- **Backend**: Laravel 12 with Jetstream, Livewire, Fortify
- **Frontend**: Blade templates with TailwindCSS and Vite
- **Authentication**: Laravel Jetstream with 2FA support
- **Database**: SQLite (default), supports MySQL/PostgreSQL
- **Queue**: Database driver (default)

### Core Models and Functionality
- **User Model**: Extended with Jetstream features (2FA, profile photos, API tokens)
  - Has `is_admin` field for admin role management
  - Uses Fortify for authentication features
- **Scholarship Model**: Core entity with fields for name, amount, country, eligibility, requirements (stored as JSON array), deadline
- **Admin System**: Separate admin controllers and middleware for scholarship and user management

### Key Application Structure
- **Admin Routes**: Prefixed with `/admin` and protected by `admin` middleware
  - Scholarship CRUD: `/admin/scholarships/*`
  - User management: `/admin/users/*`
- **Authentication**: Standard Jetstream routes for login, registration, 2FA, profile management
- **Views**: Organized by feature (admin, auth, components) with Blade components for reusability

### Important Patterns
- Controllers use resource route patterns (index, create, store, show, edit, update, destroy)
- Scholarship `application_requirements` field is cast to array in the model
- Admin middleware checks for `is_admin` field on User model
- Uses Livewire for dynamic components (AdminDashboard)

### File Organization
- Controllers: Split between general and Admin namespace
- Views: Organized by feature with shared components
- Models: Standard Laravel structure with relationships
- Middleware: Custom AdminMiddleware for role-based access

### Environment Configuration
- Default SQLite database (database/database.sqlite)
- Queue and cache use database driver
- Mail configured for local development (log driver)
- Vite for asset compilation with TailwindCSS