<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * The controller namespace for the application.
     *
     * When present, controller route declarations will automatically be prefixed with this namespace.
     *
     * @var string|null
     */
    // protected $namespace = 'App\\Http\\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::prefix('api')
                ->middleware('api')
                ->namespace($this->namespace)
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/web.php'));
        });

        $this->mapAdminRoutes();
        $this->mapUserRoutes();
        $this->mapLocalitatiRoutes();
        $this->mapDataRoutes();
        $this->mapAngajatiRoutes();
        $this->mapPozitiiRoutes();
        $this->mapStatRoutes();
        $this->mapJudeteRoutes();
        $this->mapInstitutiiRoutes();
        $this->mapCuprinsRoutes();
        $this->mapFunctiiRoutes();
        $this->mapSalarizareRoutes();
        $this->mapPontajRoutes();
        $this->mapSituatiiRoutes();
        $this->mapCalificativeRoutes();
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by(optional($request->user())->id ?: $request->ip());
        });
    }

    protected function mapAdminRoutes()
    {
        Route::prefix('/api/')
            ->group(base_path('routes/admin.php'));
    }

    protected function mapUserRoutes()
    {
        Route::prefix('/api/')
            ->group(base_path('routes/user.php'));
    }

    protected function mapLocalitatiRoutes()
    {
        Route::prefix('/api/')
            ->group(base_path('routes/localitati.php'));
    }

    private function mapDataRoutes()
    {
        Route::prefix('/api/')
            ->group(base_path('routes/data.php'));
    }

    private function mapAngajatiRoutes()
    {
        Route::prefix('/api/')
            ->group(base_path('routes/angajati.php'));
    }

    private function mapPozitiiRoutes()
    {
        Route::prefix('/api/')
            ->group(base_path('routes/pozitii.php'));
    }

    private function mapStatRoutes()
    {
        Route::prefix('/api/')
            ->group(base_path('routes/stat.php'));
    }

    private function mapJudeteRoutes()
    {
        Route::prefix('/api/')
            ->group(base_path('routes/judete.php'));
    }
    private function mapInstitutiiRoutes()
    {
        Route::prefix('/api/')
            ->group(base_path('routes/institutii.php'));
    }

    private function mapCuprinsRoutes()
    {
        Route::prefix('/api/')
            ->group(base_path('routes/cuprins.php'));
    }

    private function mapFunctiiRoutes()
    {
        Route::prefix('/api/')
            ->group(base_path('routes/functii.php'));
    }

    private function mapSalarizareRoutes()
    {
        Route::prefix('/api/')
            ->group(base_path('routes/salarizare.php'));
    }

    private function mapPontajRoutes()
    {
        Route::prefix('/api/')
            ->group(base_path('routes/pontaj.php'));
    }

    private function mapSituatiiRoutes()
    {
        Route::prefix('/api/')
            ->group(base_path('routes/situatii.php'));
    }

    private function mapCalificativeRoutes()
    {
        Route::prefix('/api/')
            ->group(base_path('routes/calificative.php'));
    }

}
