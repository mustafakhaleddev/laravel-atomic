<?php

namespace MustafaKhaled\AtomicPanel\Http\Middleware;

use Closure;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Middleware\Authenticate as BaseAuthenticationMiddleware;
use MustafaKhaled\AtomicPanel\Exceptions\AuthenticationException as AtomicAuthenticationException;

class Authenticate extends BaseAuthenticationMiddleware
{

    /**
     * Handle an incoming request.
     * @param $request
     * @param Closure $next
     * @param mixed ...$guards
     * @return mixed
     * @throws AtomicAuthenticationException
     */
    public function handle($request, Closure $next, ...$guards)
    {
        try {
            $guard = config('AtomicPanel.guard');

            if (! empty($guard)) {
                $guards[] = $guard;
            }

            return parent::handle($request, $next, ...$guards);
        } catch (AuthenticationException $e) {
            throw new AtomicAuthenticationException('Unauthenticated.', $e->guards());
        }
    }
}
