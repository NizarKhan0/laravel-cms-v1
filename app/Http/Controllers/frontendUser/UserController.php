<?php

namespace App\Http\Controllers\frontendUser;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        // dd(auth()->guard()->name);
        return view('frontend-user.module.dashboard');
    }

    public function editProfile()
    {
        $user = auth()->guard('user')->user();

        return view('frontend-user.module.profile.edit', [
            'user' => $user,
        ]);
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->guard('user')->user();

        $request->validate([
            'username' => 'required|string|max:255|unique:frontend_users,username,' . $user->id,
            'email' => 'required|email|unique:frontend_users,email,' . $user->id,
            'first_name' => 'required|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $data = [
            'username' => $request->username,
            'email' => $request->email,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('user.profile.edit')->with('success', 'Profile updated successfully.');
    }
}