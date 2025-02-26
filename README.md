# Cyberscale home challenge, events app backend

## Tech Stack

- Auth : Sanctum
- Events : Laravel Reverb
- Mail Server: Logs

## Setup

### Reverb Environment

```bash
cp .env.example .env
```

```yml
REVERB_APP_ID=
REVERB_APP_KEY=
REVERB_APP_SECRET=
REVERB_HOST=localhost
REVERB_PORT=8080
REVERB_SCHEME=http
```

- If you are using Laravel Herd with SSL, example: `https://events.test`, use:

```yml
REVERB_HOST=event.test
REVERB_PORT=8080
REVERB_SCHEME=https
```

### VSCode

- Install PHP CS FIXER

### Roles & Permissions

- At the start of the project, you want to setup the roles and permissions.
- You can do this by editing the `database/seeders/PermissionSeeder.php` file.

### Users

- At the start of the project, you want to create default users.
- You can do this by editing the `database/seeders/UserSeeder.php` file.

### Get Started

- Run the following commands to get started.

```bash
php artisan serve #skip this if you are using Laravel Herd
```

```bash
php artisan queue:work
```

```bash
php artisan reverb:start
```
