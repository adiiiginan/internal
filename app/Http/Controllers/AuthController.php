<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Show login form.
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Handle login request.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        $remember = $request->boolean('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            // If there's an intended URL (previously requested), honor it first.
            // Otherwise redirect based on user role to its role-specific page.
            $user = Auth::user();

            $roleRouteMap = [
                'superadmin' => 'role.superadmin',
                'admin' => 'role.admin',
                'sales' => 'role.sales',
                'finance' => 'role.finance',
                'gudang' => 'role.gudang',
            ];

            $defaultUrl = route('dashboard');
            $roleRoute = $roleRouteMap[$user->role] ?? null;
            $roleUrl = $roleRoute ? route($roleRoute) : $defaultUrl;

            return redirect()->intended($roleUrl);
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    /**
     * Logout the user.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    /**
     * Simple dashboard showing current user and role.
     */
    public function dashboard()
    {
        $user = Auth::user();

        return view('dashboard', compact('user'));
    }
}
