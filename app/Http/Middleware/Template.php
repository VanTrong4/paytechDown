<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\View\FileViewFinder;

class Template
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $template = null)
    {
        if ($template) {
          $finders  = new FileViewFinder(app()['files'], array(resource_path('views/' . $template)));
          View::setFinder($finders);
        }
        return $next($request);
    }
}
