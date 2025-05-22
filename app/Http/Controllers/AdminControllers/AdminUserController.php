<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Models\AdminUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $admin = AdminUser::where('email', $credentials['email'])
                         ->where('is_active', true)
                         ->first();

        if ($admin && Hash::check($credentials['password'], $admin->password)) {
            session(['is_admin' => true]);
            session(['admin_id' => $admin->id]);
            session(['admin_name' => $admin->name]);

            return redirect()->route('admin.dashboard')
                ->with('success', 'Welcome back, ' . $admin->name);
        }

        return back()->withErrors([
            'email' => 'These credentials do not match our records.'
        ])->withInput($request->only('email'));
    }

    public function logout(Request $request)
    {
        session()->forget('is_admin');
        return redirect()->route('admin.login')
            ->with('success', 'Successfully logged out');
    }
}
