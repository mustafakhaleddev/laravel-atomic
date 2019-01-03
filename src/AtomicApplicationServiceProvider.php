<?php

namespace MustafaKhaled\AtomicPanel;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use MustafaKhaled\AtomicPanel\Events\ServingAtomic;

class AtomicApplicationServiceProvider extends ServiceProvider
{
    /**
     * @throws \ReflectionException
     */
    public function boot()
    {
        $this->routes();
        AtomicPanel::serving(function (ServingAtomic $event) {
            $this->authorization();
            AtomicPanel::registerPages($this->pages());
            AtomicPanel::registerDashboardData($this->dashboardIndexData());
        });
    }

    /**
     * Register the Atomic routes.
     *
     * @return void
     */
    protected function routes()
    {
        AtomicPanel::routes()
            ->withAuthenticationRoutes()
            ->withPasswordResetRoutes();
    }

    /**
     * Configure the Atomic authorization services.
     *
     * @return void
     */
    protected function authorization()
    {
        $this->gate();

        AtomicPanel::auth(function ($request) {
            return app()->environment('local') ||
                Gate::check('viewAtomic', [$request->user()]);
        });
    }

    /**
     * Register the panel gate.
     * This gate determines who can access panel in non-local environments.
     *
     * @return void
     */
    protected function gate()
    {
        Gate::define('viewAtomic', function ($user) {
            return in_array($user->email, [
                //
            ]);
        });
    }


    /**
     * Get the pages that should be displayed on the atomic dashboard.
     *
     * @return array
     */
    protected function pages()
    {
        return [];
    }


    /**
     * dashboard index view compacting data
     * @return array
     */
    protected function dashboardIndexData()
    {
        return [];
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }


}
