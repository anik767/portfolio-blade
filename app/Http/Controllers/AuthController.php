<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Show login form
    public function showLogin()
    {
        return view('auth.login');
    }

    // Handle login form submission
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (!Auth::attempt($credentials)) {
            return back()->withErrors([
                'email' => 'Invalid credentials.',
            ])->withInput();
        }

        $request->session()->regenerate();
        /** @var User $user */
        $user = Auth::user();

        // Optionally store IP
        $user->ip_address = $request->ip();
        $user->save();

        // Redirect to admin dashboard or wherever
        return redirect()->intended(route('admin.dashboard'));
    }

    // Logout user
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect(route('admin.login'))->with('status', 'Logged out successfully.');
    }

    // Show password reset form (optional, you need blade for this)
    public function showResetPasswordForm()
    {
        return view('auth.reset_password');
    }

    // Handle password reset
    public function resetPassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|string',
            'password' => 'required|string|confirmed|min:8',
        ]);

        $user = $request->user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect']);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('admin.dashboard')->with('success', 'Password updated successfully');
    }
}
