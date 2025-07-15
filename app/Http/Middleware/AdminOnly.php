<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminOnly
{
    public function handle(Request $request, Closure $next)
    {
        // Pastikan user sudah login sebagai admin
        if (!Auth::guard('admin')->check()) {
            return redirect()->route('admin.login')->withErrors(['email' => 'Silakan login sebagai admin.']);
        }

        // Opsional: cek role jika field 'role' ada di tabel admin
        $user = Auth::guard('admin')->user();
        if (isset($user->role) && $user->role !== 'admin') {
            Auth::guard('admin')->logout();
            return redirect()->route('admin.login')->withErrors(['email' => 'Anda tidak memiliki hak akses admin.']);
        }

        return $next($request);
    }
}
