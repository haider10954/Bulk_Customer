<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        if ($request->segment(1) == 'admin') {
            session()->put('redirect_route', ($request->route()->getName()));
            return route('admin_login');
        }
        return route('user_login');
    }
}
