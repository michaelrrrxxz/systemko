<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Response;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Illuminate\Http\RedirectResponse;
class LoginController extends Controller
{
    public function showLoginForm()
    {
        return inertia('Auth/Login');
    }

    public function login(Request $request)
    {
        // Validate incoming request
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt to authenticate the user
        if (auth()->attempt($request->only('email', 'password'))) {
            // After successful login, redirect to the dashboard


            $user = Auth::user(); // Get the authenticated user
           return redirect()->route('dashboard.index');
        }

        // If authentication fails, return back with error message
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

}

