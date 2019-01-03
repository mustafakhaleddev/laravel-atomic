<?php

namespace MustafaKhaled\AtomicPanel\Http\Middleware;

use MustafaKhaled\AtomicPanel\AtomicPanel;

class Authorize
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Illuminate\Http\Response
     */
    public function handle($request, $next)
    {
        return AtomicPanel::check($request) ? $next($request) : abort(403);
    }
}
