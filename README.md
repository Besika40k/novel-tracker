# Novel Tracker

**Student:** Beso Meskhia
**Course:** Web Application Development (Laravel MVC), Kutaisi International University, midterm project

Novel Tracker is a small Laravel app for keeping track of the web novels you read. Each novel has
a title, an author, the country it comes from, a reading status, how many chapters you have read
out of the total, your rating and whether it is a favourite. You can add, edit and delete novels,
search by title or author, filter the list by status (search and filter work together), and page
through the list ten novels at a time. Forms are validated, and errors show under each field
without losing what you typed.

## The `novels` table

| Column | Type | Notes |
| --- | --- | --- |
| id | bigint, auto-increment | Primary key |
| title | string(150) | Searched |
| author | string(100) | Searched |
| origin | string(20) | chinese, korean, japanese or english |
| status | string(20) | **Filter:** reading, planned, completed or dropped |
| chapters_read | integer | Default 0 |
| total_chapters | integer | |
| rating | decimal(3,1) | 0.0 to 10.0 |
| is_favourite | boolean | Default false; shown as a badge |
| created_at, updated_at | timestamp | Filled in by Laravel |

## How to run it

Requirements: PHP 8.3 or newer, Composer, and MySQL (for example XAMPP).

1. Start MySQL and create the database (for example in phpMyAdmin):
   ```sql
   CREATE DATABASE novel_tracker_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
   ```
2. In the project folder, install the packages and set up the environment file:
   ```bash
   composer install
   cp .env.example .env
   php artisan key:generate
   ```
   On Windows `cmd`, use `copy .env.example .env` instead of `cp`. `.env.example` already uses
   MySQL with the database `novel_tracker_db`, user `root` and an empty password; change them in
   `.env` if your MySQL differs.
3. Build the table and fill it with 20 sample novels:
   ```bash
   php artisan migrate:fresh
   php artisan db:seed --class=NovelSeeder
   ```
4. Start the app:
   ```bash
   php artisan serve
   ```
   and open http://127.0.0.1:8000 (it redirects to the list at `/novels`).

## Where things are

| File | What it does |
| --- | --- |
| `routes/web.php` | `/` redirects to the list; the six named `novels.*` routes |
| `app/Http/Controllers/NovelController.php` | List with search, filter and pagination; add, edit, delete; validation |
| `app/Models/Novel.php` | The model: fillable columns, casts, the allowed origins and statuses |
| `database/migrations/*_create_novels_table.php` | Creates the `novels` table |
| `database/seeders/NovelSeeder.php` | 20 real novels |
| `resources/views/layouts/app.blade.php` | The page frame shared by every page |
| `resources/views/partials/` | The header and the flash message |
| `resources/views/novels/` | The list, the add and edit pages, and the form they share |
| `public/css/app.css` | Plain CSS (no build step) |

## Screenshots

The `screenshots/` folder has the list, a search result, the add form and the edit form.
