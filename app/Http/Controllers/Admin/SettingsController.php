<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SettingsController extends Controller
{
    // Tampilkan halaman pengaturan profil admin
    public function profile()
    {
        $admin = Auth::guard('admin')->user();
        return view('admin.settings.profile', compact('admin'));
    }

    // Update profil admin
    public function updateProfile(Request $request)
    {
        $admin = Auth::guard('admin')->user();

        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:admins,email,' . $admin->id,
        ]);

        $admin->update($request->only('name', 'email'));

        return back()->with('success', 'Profil berhasil diperbarui.');
    }

    // Tampilkan form ubah password
    public function password()
    {
        return view('admin.settings.password');
    }

    // Update password admin
    public function updatePassword(Request $request)
    {
        $admin = Auth::guard('admin')->user();

        $request->validate([
            'current_password' => 'required',
            'password'         => 'required|string|min:8|confirmed',
        ]);

        if (!Hash::check($request->current_password, $admin->password)) {
            return back()->withErrors(['current_password' => 'Password lama salah.']);
        }

        $admin->password = Hash::make($request->password);
        $admin->save();

        return back()->with('success', 'Password berhasil diubah.');
    }
}
