<?php namespace App\Http\Middleware;

use Closure;

class Admin
{
    /**
     * Run the request filter.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (! $request->user()->email == env('SUPERUSER_EMAIL') )
            return response('Unauthorized.', 401);

        return $next($request); //next middleware
    }

}
