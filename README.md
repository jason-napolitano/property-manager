# Full Stack Boilerplate

> The following technologies were used to create this full-stack development boilerplate

- Vue 3 + Vite + Vitest
- Element Plus
- Laravel 10
- PrimeIcons

## Installation

1. Clone / copy the repository and `cd` into it
   ```bash
   $ cd /path/to/project
   ```
2. Install the dependencies

   ```bash
   $ npm install
   ```

   ```bash
   $ composer install
   ```

3. Copy the `.env.example` file as `.env`
4. Generate the application key
   ```bash
   $ php artisan key:generate
   ```
5. Configure the database credentials in the `.env` file
6. Perform the migrations
   ```bash
   $ php artisan migrate --seed
   ```
7. Create the symbolic link for storagte
   ```bash
   $ php artisan storage:link
   ```

### Credentials

```
Email: admin@example.com
Password: password
```

```
Email: manager@example.com
Password: password
```
