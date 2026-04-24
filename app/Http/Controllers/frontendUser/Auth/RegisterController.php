<?php

namespace App\Http\Controllers\frontendUser\Auth;

use App\Http\Controllers\Controller;
use App\Models\backendUser\FrontendUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function register()
    {
        return view('frontend-user.auth.register');
    }

    public function registerSubmit(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|string|max:50|unique:frontend_users,username',
            'first_name' => 'required|string|max:100',
            'last_name' => 'nullable|string|max:100',
            'email' => 'required|email|unique:frontend_users,email',
            'password' => 'required|min:8|confirmed',
        ]);

        // dd($request->all());

        $user = FrontendUser::create([
            'username' => $request->username,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => $request->password, // auto hash sebab model casts
            'is_active' => 1,
            'last_login_at' => now(),
        ]);

        //auto login lepas register
        // Use the frontend user guard for login after registration
        Auth::guard('user')->login($user);

        $user->sendEmailVerificationNotification();

        return redirect()->route('user.verification.notice');
    }
}