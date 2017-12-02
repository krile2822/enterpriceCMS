<?php

namespace CMS\Front\Middleware;

use Closure;
use Illuminate\Routing\Redirector;
use Illuminate\Http\Request;
use Illuminate\Foundation\Application;
//use Illuminate\Contracts\Routing\Middleware;

class Language  {

    public function __construct(Application $app, Redirector $redirector, Request $request) {
        $this->app = $app;
        $this->redirector = $redirector;
        $this->request = $request;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
      if (count($this->app->config->get('app.locales')) > 1) {
        // Make sure current locale exists.
        $locale = $request->segment(1);

        if ( ! array_key_exists($locale, $this->app->config->get('app.locales'))) {
            $segments = $request->segments();
            $segments[0] = $this->app->config->get('app.fallback_locale');

            //return $this->redirector->to(implode('/', $segments));

            $newUrl = implode('/', $segments);
            if (array_key_exists('QUERY_STRING', $_SERVER))
                $newUrl .= '?'.$_SERVER['QUERY_STRING'];
            return $this->redirector->to($newUrl);
        }
        $this->app->setLocale($locale);

        return $next($request);
      } else {
        return $next($request);
      }

    }

}
