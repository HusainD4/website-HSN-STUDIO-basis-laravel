<?php

namespace App\Http\Middleware;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo(Request $request): ?string
    {
        if ($request->expectsJson()) {
            return null;
        }

        // Jika request adalah untuk route di dalam grup 'admin',
        // arahkan pengguna ke halaman login admin.
        if ($request->is('admin') || $request->is('admin/*')) {
            return route('admin.login');
        }
        
        // Untuk semua kasus lainnya, arahkan ke halaman login customer.
        // Route 'login' ini sudah kita atur di routes/web.php agar mengarah ke /hsnstudio/login
        return route('user.login');
    }
}
