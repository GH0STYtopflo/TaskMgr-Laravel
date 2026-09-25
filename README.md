# Task Manager - Laravel

A task management application built with Laravel, featuring server-side rendering with Blade templates, database persistence with PostgreSQL, and role-based access control.

## Technology Stack

- **Framework**: Laravel
- **Templating**: Blade
- **ORM**: Eloquent
- **Database**: PostgreSQL
- **Authentication**: Session-based with Gates and Policies

## Authorization

The application implements a two-tier authorization system:

- **Gates**: Restrict administrative actions and routes to administrators only
- **Policies**: Provide fine-grained authorization based on resource ownership and user permissions

## User Permissions

### Administrators
- Create and manage categories
- Create and manage tasks
- Manage comments
- Manage users

### Regular Users
- Sign up and maintain account
- Comment on tasks
- Mark tasks as completed
- Mark subtasks as completed

## Prerequisites

- Docker
- Docker Compose

## Installation

1. Clone the repository and navigate to the project directory

2. Create a `.env` file in the project root with the following configuration:

```env
# Docker Configuration
POSTGRES_DB=taskmgr
POSTGRES_USER=postgres
POSTGRES_PASSWORD=postgres

# Laravel Database Configuration
DB_CONNECTION=pgsql
DB_HOST=pgsql
DB_PORT=5432
DB_DATABASE=taskmgr
DB_USERNAME=postgres
DB_PASSWORD=postgres
```

3. Build and start the application:

```bash
docker-compose up --build
```

The application will be accessible at `http://localhost:8000`

## Default Administrator Account

A default administrator account is automatically created on first run:

- **Username**: ghosty
- **Password**: unfortunatelyghostymissedthistime

## Project Structure

The application follows standard Laravel conventions with Blade templates for views, Eloquent models for database access, and middleware for request handling.
