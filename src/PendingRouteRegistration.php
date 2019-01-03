<?php

namespace MustafaKhaled\AtomicPanel;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Route;

class PendingRouteRegistration
{
    /**
     * Indicates if the routes have been registered.
     * @var bool
     */
    protected $registered = false;

    /**
     * Register the authentication routes.
     * @param  array $middleware
     * @return $this
     */
    public function withAuthenticationRoutes($middleware = ['web'])
    {
        Route::namespace('MustafaKhaled\AtomicPanel\Http\Controllers\Auth')
            ->domain(config('atomicPanel.domain', null))
            ->middleware($middleware)
            ->as('AtomicPanel.')
            ->prefix(AtomicPanel::path())
            ->group(function () {
                Route::get('/login', 'LoginController@showLoginForm');
                Route::post('/login', 'LoginController@login')->name('login');
            });

        return $this;
    }

    /**
     * Register the password reset routes.
     * @param  array $middleware
     * @return $this
     */
    public function withPasswordResetRoutes($middleware = ['web'])
    {
        AtomicPanel::$resetsPasswords = true;

        Route::namespace('MustafaKhaled\AtomicPanel\Http\Controllers\Auth')
            ->domain(config('AtomicPanel.domain', null))
            ->middleware($middleware)
            ->as('AtomicPanel.')
            ->prefix(AtomicPanel::path())
            ->group(function () {
                Route::get('/password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.request');
                Route::post('/password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');
                Route::get('/password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset');
                Route::post('/password/reset', 'ResetPasswordController@reset');
            });

        return $this;
    }

    /**
     * Register the  routes.
     * @return void
     */
    public function register()
    {
        $this->registered = true;

        Route::namespace('MustafaKhaled\AtomicPanel\Http\Controllers\Auth')
            ->domain(config('AtomicPanel.domain', null))
            ->middleware(config('AtomicPanel.middleware', []))
            ->as('AtomicPanel.')
            ->prefix(AtomicPanel::path())
            ->group(function () {
                Route::get('/logout', 'LoginController@logout')->name('logout');
            });

    }

    /**
     * Handle the object's destruction and register the router route.
     * @return void
     */
    public function __destruct()
    {
        if (!$this->registered) {
            $this->register();
        }
    }
}
