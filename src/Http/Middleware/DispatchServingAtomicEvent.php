<?php

namespace MustafaKhaled\AtomicPanel\Http\Middleware;

use MustafaKhaled\AtomicPanel\Events\ServingAtomic;

class DispatchServingAtomicEvent
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
        ServingAtomic::dispatch($request);

        return $next($request);
    }
}
