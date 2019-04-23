<?php

namespace App\Modules\Admin\Http\Middleware;

use Closure;
use App\Exceptions\RestrictedAreaException;

class Admin
{
  public function handle($request, Closure $next, $guard = null)
  {
      if (auth()->user()->roles[0]->id != 1) {
        
          throw new RestrictedAreaException();
      }

      return $next($request);
  }
}
