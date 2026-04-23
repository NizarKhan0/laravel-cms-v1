<?php

namespace App\Http\Controllers\frontendUser\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login()
    {
        return view('frontend-user.auth.login');
    }

    public function loginSubmit(Request $request)
    {
        $request->validate([
            'login' => ['required', 'string'],
            'password' => ['required'],
        ]);

        $loginField = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $credentials = [
            $loginField => $request->login,
            'password' => $request->password,
        ];

        if (Auth::guard('user')->attempt($credentials, $request->boolean('remember'))) {

            $request->session()->regenerate();

            // Update last login timestamp for the admin user without triggering activity log
            if ($admin = Auth::guard('user')->user()) {
                // Only set if the column exists in the model/table
                if (in_array('last_login_at', array_keys($admin->getAttributes()))) {
                    // Use updateQuietly to avoid logging and model events
                    $admin->updateQuietly(['last_login_at' => now()]);
                }
            }

            return redirect()->intended('/user/dashboard');
        }

        return back()->withErrors([
            'login' => 'The provided credentials do not match our records.',
        ])->onlyInput('login');
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('user.login');
    }
}