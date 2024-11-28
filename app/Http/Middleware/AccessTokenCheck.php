<?php

namespace App\Http\Middleware;

use App\Common\AuthMiddlewareTrait;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\Finder\Exception\AccessDeniedException;

class AccessTokenCheck
{
    use AuthMiddlewareTrait;

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     * @throws AccessDeniedException
     */
    public function handle(Request $request, Closure $next)
    {
        $this->checkAuthToken($request);

        return $next($request);
    }
}
