<?php

namespace MustafaKhaled\AtomicPanel\Http\Middleware;

use MustafaKhaled\AtomicPanel\AtomicPanel;
use MustafaKhaled\AtomicPanel\AtomicPanelServiceProvider;
use MustafaKhaled\AtomicPanel\Events\AtomicServiceProviderRegistered;

class AtomicPageMiddleware
{
    /**
     * Handle the incoming request for page.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return \Illuminate\Http\Response
     */
    public function handle($request, $next)
    {
        if ($this->isAtomicRequest($request)) {
            app()->register(AtomicPanelServiceProvider::class);
            AtomicServiceProviderRegistered::dispatch();
        }
        $page = AtomicPanel::checkPageRoute($request->route()->getAction('as'));
        if (!$page) abort(404);
        if (!$page->canSee) abort(403);


        return $next($request);
    }

    /**
     * Determine if the given request is intended for Atomic.
     *
     * @param  \Illuminate\Http\Request $request
     * @return bool
     */
    protected function isAtomicRequest($request)
    {
        $path = trim(AtomicPanel::path(), '/') ?: '/';
        return $request->is($path) ||
            $request->is(trim($path . '/*', '/'));
    }
}
