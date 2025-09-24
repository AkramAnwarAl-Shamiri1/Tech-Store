Full Laravel backend package (generated skeleton)
================================================

What's included:
- database/migrations/*  - one migration per model/table (templates)
- app/Models/*           - basic models with $fillable
- app/Policies/*         - policy per model with basic role checks
- app/Http/Controllers/* - resource controllers returning JSON and using $this->authorize()
- app/Http/Middleware/RoleMiddleware.php
- app/Providers/AuthServiceProvider.php - policy mappings
- database/seeders/RoleAndUserSeeder.php - creates roles + 3 users
- routes/api.php - API resource routes (protected by auth:sanctum middleware)
- README_BACKEND_PACKAGE.md (this file)

How to use (on your Laravel project):
1. Copy files into your Laravel project root (merge with existing files).
2. Update composer.json / run composer dump-autoload if needed.
3. Register middleware in app/Http/Kernel.php:
   'role' => \App\Http\Middleware\RoleMiddleware::class,
4. Run migrations:
   php artisan migrate
   (you may need to adjust migration timestamps or filenames to avoid collisions)
5. Seed roles and users:
   php artisan db:seed --class=Database\\Seeders\\RoleAndUserSeeder
6. Protect API with Sanctum or use session auth; check routes/api.php and adjust middleware.
7. Replace validation and fillable fields with real rules for production.

Notes:
- This is a generated skeleton to speed development. You must review and adapt the policies and controllers to match your exact ownership rules and business logic.
- Controllers currently use permissive validation ['*' => 'sometimes'] — replace with precise rules or FormRequest classes.

