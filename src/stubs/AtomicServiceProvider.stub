<?php

namespace App\Providers;

use MustafaKhaled\AtomicPanel\AtomicPanel;
use Illuminate\Support\Facades\Gate;
use MustafaKhaled\AtomicPanel\AtomicApplicationServiceProvider;

class AtomicServiceProvider extends AtomicApplicationServiceProvider
{
    /**
     * @throws \ReflectionException
     */
    public function boot()
    {
        parent::boot();
    }

    /**
     * Register the Atomic gate.
     *
     * This gate determines who can access Atomic in non-local environments.
     *
     * @return void
     */
    protected function gate()
    {
        Gate::define('viewAtomic', function ($user) {
            return in_array($user->email, [
              'atomic@mustafakhaled.com'
            ]);
        });
    }

    /**
     * Register Application Pages
     * @return array
     */
    protected function pages()
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
