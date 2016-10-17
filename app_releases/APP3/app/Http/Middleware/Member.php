<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;

class Member {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */

	public function handle($request, Closure $next)
    {
        if (! session('user_name') )
            return new RedirectResponse(url('/'));
        
        return $next($request); //next middleware
    }
	

}
