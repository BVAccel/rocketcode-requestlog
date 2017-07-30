<?php

namespace Rocketcode\RequestLog;

use Illuminate\Support\ServiceProvider;

class RequestLogServiceProvider extends ServiceProvider {
	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		## TODO:  Let's add some UI helpers in the future.

		$this->publishes( [
			__DIR__.'/config'   => base_path('config'),
			__DIR__.'/database' => base_path('database/migrations'),
		] );
	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}
}
