<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class SystemSetting
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->mobileSystemAccount == 'admin') {
                return $next($request);
            }
            return redirect('error');
        }
        $url = urlencode(request()->url());
        return redirect()->to(env('PORTAL', '/').'?url='.$url);
    }
}
