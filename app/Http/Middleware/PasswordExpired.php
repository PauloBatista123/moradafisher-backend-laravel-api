<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class PasswordExpired
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();

        $password_expire = new Carbon(($user->expire_in) ? $user->expire_in : $user->created_at);

        if (Carbon::now()->diffInDays($password_expire) >= config('auth.password_expires_days')) {

            return Redirect::route('password.expired');
        }

        return $next($request);
    }
}
