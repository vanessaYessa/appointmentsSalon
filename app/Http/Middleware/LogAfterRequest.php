<?php

namespace App\Http\Middleware;


use Closure;
use Illuminate\Contracts\Routing\TerminableMiddleware;
use Illuminate\Support\Facades\Log;

class LogAfterRequest implements TerminableMiddleware {

	public function handle($request, Closure $next)
	{
		return $next($request);
	}

	public function terminate($request, $response)
	{
		Log::info('app.requests', ['request' => $request->all()]);
	}

}