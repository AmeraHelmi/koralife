<?php namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel {

	public function bootstrap() {
        parent::bootstrap(); // should have loaded environment detection now.
        if (env('APP_DEBUG'))
            $this->pushMiddleware('Clockwork\Support\Laravel\ClockworkMiddleware');
    }

	/**
	 * The application's global HTTP middleware stack.
	 *
	 * @var array
	 */
	protected $middleware = [
		'Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode',
		'Illuminate\Cookie\Middleware\EncryptCookies',
		'Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse',
		'Illuminate\Session\Middleware\StartSession',
		'Illuminate\View\Middleware\ShareErrorsFromSession',
	    'Clockwork\Support\Laravel\ClockworkMiddleware',

	];

	/**
	 * The application's route middleware.
	 *
	 * @var array
	 */
	protected $routeMiddleware = [
		'admin'      => 'App\Http\Middleware\Admin',
		'auth'       => 'App\Http\Middleware\Authenticate',
		'member'     => 'App\Http\Middleware\Member',
		'auth.basic' => 'Illuminate\Auth\Middleware\AuthenticateWithBasicAuth',
		'guest'      => 'App\Http\Middleware\RedirectIfAuthenticated',
	];

}
