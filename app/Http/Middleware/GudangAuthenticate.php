<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class GudangAuthenticate extends Middleware
{
  /**
   * Get the path the user should be redirected to when they are not authenticated.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return string|null
   */
  protected function redirectTo($request)
  {
    if (! $request->expectsJson()) {
      return route('gudang.login');
    }
  }

  /**
   * Handle an incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure  $next
   * @param  string[]  ...$guards
   * @return mixed
   *
   * @throws \Illuminate\Auth\AuthenticationException
   */
  public function handle($request, Closure $next, ...$guards)
  {
    // Specify the gudang guard
    $guards = ['gudang'];

    $this->authenticate($request, $guards);

    return $next($request);
  }
}
