<?php

namespace App\Http\Controllers\backendUser\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthenticatedSessionController extends Controller
{
    /**
     * Show login page
     */
    public function create()
    {
        return view('backend-user.auth.login');
    }

    /**
     * Handle login request
     */
    public function store(Request $request)
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

        if (Auth::guard('admin')->attempt($credentials, $request->boolean('remember'))) {

            $request->session()->regenerate();

            // Update last login timestamp for the admin user without triggering activity log
            if ($admin = Auth::guard('admin')->user()) {
                // Only set if the column exists in the model/table
                if (in_array('last_login_at', array_keys($admin->getAttributes()))) {
                    // Use updateQuietly to avoid logging and model events
                    $admin->updateQuietly(['last_login_at' => now()]);
                }
            }

            //  dd(Auth::getDefaultDriver());
            // dd([
            //     'guard_admin' => Auth::guard('admin')->check(),
            //     'admin_user' => Auth::guard('admin')->user(),
            //     'guard_user' => Auth::guard('user')->check(),
            //     'user_user' => Auth::guard('user')->user(),
            // ]);

            return redirect()->intended('/admin/dashboard');
        }

        return back()->withErrors([
            'login' => 'The provided credentials do not match our records.',
        ])->onlyInput('login');
    }

    /**
     * Logout admin
     */
    public function destroy(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }

    /**
     * Show forgot password page
     */
    public function forgotPassword()
    {
        return view('backend-user.auth.forgot-password');
    }

    /**
     * Send reset password link email
     */
    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => ['required','email']
        ]);

        $status = Password::broker('admin')->sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with('status', __($status))
            : back()->withErrors(['email' => __($status)]);
    }

    /**
     * Show reset password form
     */
    public function resetPasswordForm(Request $request, $token)
    {
        return view('backend-user.auth.reset-password', [
            'token' => $token,
            'email' => $request->query('email'),
        ]);
    }

    /**
     * Handle reset password
     */
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => ['required'],
            'email' => ['required','email'],
            'password' => ['required','confirmed','min:8'],
        ]);

        $status = Password::broker('admin')->reset(
            $request->only('email','password','password_confirmation','token'),
            function ($user) use ($request) {

                $user->forceFill([
                    'password' => Hash::make($request->password),
                    'remember_token' => Str::random(60),
                ])->save();
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('admin.login')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }
}
