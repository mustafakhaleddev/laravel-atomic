<?php

namespace MustafaKhaled\AtomicPanel;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;


class AtomicWidgetServiceProvider extends ServiceProvider
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
     * Get the Atomic route group configuration array.
     *
     * @return array
     */
    protected function routeConfiguration()
    {
        return [
            'namespace' => AtomicPanel::classNamespace($this->registerWidget()) . '\Http\Controllers',
            'domain' => config('AtomicPanel.domain', null),
            'as' => $this->registerWidget()::routePath() . '.',
            'prefix' => AtomicPanel::path() . '/' . $this->registerWidget()::path(),
            'middleware' => ['atomic'],
        ];
    }

    /**
     * register widget class
     * @return null
     */
    protected function registerWidget()
    {
        return null;
    }

}
