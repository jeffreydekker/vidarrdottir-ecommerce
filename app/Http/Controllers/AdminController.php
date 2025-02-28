<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{

    public function showAdminLogin()
    {
        if (Auth::check() && Auth::user()->isAdmin)
        {
            return redirect()->route('admin.dashboard');
        }

        return view('adminLogin');
    }



    public function adminLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // // Generate a unique key for tracking login attempts
        $key = 'login-attempts:' . Str::lower($request->email) . '|' . $request->ip();

        // Check if the user has exceeded the allowed attempts
        if (RateLimiter::tooManyAttempts($key, 3)) {
            return redirect('/admin')->withErrors([
                'email' => 'Too many login attempts. Please try again in 24 hours.'
            ]);
        }

        // Increment the attempt count before attempting authentication
        RateLimiter::hit($key, 1440 * 60);

        // Prevent login if the user has exceeded the allowed attempts (even with correct credentials)
        if (RateLimiter::tooManyAttempts($key, 3)) {
            return redirect('/admin')->withErrors([
                'email' => 'Too many login attempts. Please try again in 24 hours.'
            ]);
        }

        // Attempt login only if the rate limit has not been exceeded
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            if (Auth::user()->isAdmin) {
                RateLimiter::clear($key); // Reset attempts on successful login
                return redirect()->route('admin.dashboard');
            }
        }

        Auth::logout();
        return redirect('/admin')->withErrors(['email' => 'Invalid credentials or not an admin.']);
    }



    public function adminDashboard()
    {
        return view('admin.adminDashboard');
    }

    public function adminLogout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Logged out successfully.');
    }

    public function orders()
    {
        return view('admin.orders.index');
    }

    public function customers()
    {
        return view('admin.customers.index');
    }

    public function reports()
    {
        return view('admin.reports.index');
    }

    public function settings()
    {
        return view('admin.settings.index');
    }
}
