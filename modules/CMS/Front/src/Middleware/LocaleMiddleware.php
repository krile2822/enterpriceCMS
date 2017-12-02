<?php

namespace CMS\Front\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Application;

use Session;
use CMS\Front\Languages;
use Request;

class LocaleMiddleware
{

    public function __construct(Application $app) {
        $this->app = $app;
    }
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        return $next($request);
    }
}
