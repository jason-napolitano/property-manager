<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        // --------------------------------------------------------------------
        // route limiting -----------------------------------------------------
        RateLimiter::for('api', static function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        // --------------------------------------------------------------------
        // base routes --------------------------------------------------------
        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));

            // ----------------------------------------------------------------
            // authentication routes ------------------------------------------
            Route::middleware('web')
                ->prefix('auth')
                ->group(base_path('routes/auth.php'));

            // ----------------------------------------------------------------
            // dashboard routes -----------------------------------------------
            Route::middleware(['web', 'auth', 'can:view_dashboard'])
                ->prefix('dashboard')
                ->group(base_path('routes/app/dashboard.php'));

            Route::middleware(['web', 'auth', 'can:manage_categories'])
                ->prefix('dashboard')
                ->group(base_path('routes/app/categories.php'));

            Route::middleware(['web', 'auth', 'can:manage_properties'])
                ->prefix('dashboard')
                ->group(base_path('routes/app/properties.php'));

            Route::middleware(['web', 'auth', 'can:manage_buildings'])
                ->prefix('dashboard')
                ->group(base_path('routes/app/buildings.php'));

            Route::middleware(['web', 'auth', 'can:manage_projects'])
                ->prefix('dashboard')
                ->group(base_path('routes/app/projects.php'));

            Route::middleware(['web', 'auth', 'can:manage_tasks'])
                ->prefix('dashboard')
                ->group(base_path('routes/app/tasks.php'));

            Route::middleware(['web', 'auth', 'can:manage_users'])
                ->prefix('dashboard')
                ->group(base_path('routes/app/users.php'));
        });
    }
}
