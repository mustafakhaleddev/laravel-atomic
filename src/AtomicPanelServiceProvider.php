<?php

namespace MustafaKhaled\AtomicPanel;

use Illuminate\Support\ServiceProvider;
use MustafaKhaled\AtomicPanel\Console\ActionCommand;
use MustafaKhaled\AtomicPanel\Console\FieldCommand;
use MustafaKhaled\AtomicPanel\Console\InstallCommand;
use Illuminate\Support\Facades\Route;
use MustafaKhaled\AtomicPanel\Console\PageCommand;
use MustafaKhaled\AtomicPanel\Console\PublishCommand;
use MustafaKhaled\AtomicPanel\Console\UserCommand;
use MustafaKhaled\AtomicPanel\Console\WidgetCommand;

class AtomicPanelServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');

        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'atomic');
        $this->publishConfig();
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'atomic');

        $this->publishes([
            __DIR__ . '/../resources/views/partials' => base_path('resources/views/vendor/atomic/partials'),
        ], 'atomic-resources');

        $this->publishes([
            __DIR__ . '/../public' => public_path('vendor/atomic'),
        ], 'atomic-public');

        $this->publishes([
            __DIR__ . '/stubs/AtomicServiceProvider.stub' => app_path('Providers/AtomicServiceProvider.php'),
        ], 'atomic-provider');

        $this->publishes([
            __DIR__ . '/../resources/lang' => resource_path('lang/vendor/atomic'),
        ], 'atomic-lang');

        $this->registerRoutes();


    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfig();
        $this->commands([
            InstallCommand::class,
            PublishCommand::class,
            FieldCommand::class,
            PageCommand::class,
            WidgetCommand::class,
            UserCommand::class,
            ActionCommand::class,
        ]);
        $this->app->make('MustafaKhaled\AtomicPanel\Http\Controllers\AtomicController');
        if (!defined('ATOMIC_PATH')) {
            define('ATOMIC_PATH', realpath(__DIR__ . '/../'));
        }
        Route::middlewareGroup('atomic', config('AtomicPanel.middleware', []));
        Route::middlewareGroup('atomicPage', config('AtomicPanel.pageMiddleware', []));

    }


    /**
     * Register the package routes.
     *
     * @return void
     */
    protected function registerRoutes()
    {
        Route::group($this->routeConfiguration(), function () {
            $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
        });
    }

    /**
     * Get the Atomic route group configuration array.
     *
     * @return array
     */
    protected function routeConfiguration()
    {
        return [
            'namespace' => 'MustafaKhaled\AtomicPanel\Http\Controllers',
            'domain' => config('AtomicPanel.domain', null),
            'as' => AtomicPanel::routePath() . '.',
            'prefix' => AtomicPanel::path(),
            'middleware' => 'atomic',
        ];
    }

    /**
     * merge awt config file with application config files
     */
    private function mergeConfig()
    {
        $path = $this->getConfigPath();
        $this->mergeConfigFrom($path, 'AtomicPanel');
    }

    /**
     * publish awt config file to application config folder
     */
    private function publishConfig()
    {
        $path = $this->getConfigPath();
        $this->publishes([$path => config_path('AtomicPanel.php')], 'atomic-config');
    }


    /**
     * return package awt config file dir
     * @return string
     */
    private function getConfigPath()
    {
        return __DIR__ . '/../config/AtomicPanel.php';
    }

}
