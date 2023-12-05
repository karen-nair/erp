## Steps to deploy in localhost

1. rename env.example to env and add in right credentials for your database
2. run: composer update
3. run: php artisan migrate
4. run: php artisan db:seed
5. run: php artisan make:filament-user
6. key in name, email and password in the console/terminal. This will be used for amdin login later.
7. run: php artisan migrate
8. run: php artisan key:generate
9. run: php artisan serve

access the admin logn at: http://127.0.0.1:8000/admin/
