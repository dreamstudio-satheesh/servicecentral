<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class HandlePageExpired
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Check if the response has a 419 status code
        if ($response instanceof Response && $response->getStatusCode() === 419) {
            return redirect('/')->with('error', 'Session expired. Please try again.');
        }

        return $response;
    }
}
