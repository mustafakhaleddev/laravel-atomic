<?php

namespace MustafaKhaled\AtomicPanel;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;


class AtomicPageServiceProvider extends ServiceProvider
{


    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerRoutes();
        $this->registerViews();
    }




    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {

    }


    /**
     * Register the package routes.
     *
     * @return void
     */
    protected function registerRoutes()
    {

    }


    /**
     * Register the package views.
     *
     * @return void
     */
    protected function registerViews()
    {

    }

    /**
     * Get the Atomic page route group configuration array.
     *
     * @return array
     */
    protected function routeConfiguration()
    {
        return [
            'namespace' => AtomicPanel::classNamespace($this->registerPage()) . '\Http\Controllers',
            'domain' => config('AtomicPanel.domain', null),
            'as' => $this->registerPage()::routePath() . '.',
            'prefix' => AtomicPanel::path() . '/' . $this->registerPage()::path(),
            'middleware' => ['atomic','atomicPage'],
        ];
    }

    protected function registerPage()
    {
        return null;
    }

}
