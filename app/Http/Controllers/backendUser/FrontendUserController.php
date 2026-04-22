<?php

namespace App\Http\Controllers\backendUser;

use App\Http\Controllers\Controller;
use App\Http\Requests\backendUser\UserRequest;
use App\Models\backendUser\FrontendUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class FrontendUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $frontendUsers = FrontendUser::orderBy('created_at', 'desc')->paginate(10);

        return view(
            'backend-user.module.frontendUser.index',
            [
                'frontendUsers' => $frontendUsers
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view(
            'backend-user.module.frontendUser.create'
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        // Validation is automatically handled by UserRequest

        $user = FrontendUser::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'is_active' => $request->is_active ?? 1,
        ]);

        // OPTIONAL: send verification email
        if ($request->send_verification_email) {
            $user->sendEmailVerificationNotification();
        }

        flash()->use('theme.ios')->success('Frontend User created successfully!');

        return redirect()->route('frontend-user.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $frontendUsers = FrontendUser::findOrFail($id);

        return view(
            'backend-user.module.frontendUser.show',
            [
                'frontendUsers' => $frontendUsers
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $frontendUsers = FrontendUser::findOrFail($id);

        return view(
            'backend-user.module.frontendUser.edit',
            [
                'frontendUsers' => $frontendUsers
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, $id)
    {
        $frontendUsers = FrontendUser::findOrFail($id);

        $data = [
            'username' => $request->username,
            'email' => $request->email,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'is_active' => $request->is_active ?? $frontendUsers->is_active,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $frontendUsers->update($data);

        flash()->use('theme.ios')->success('Frontend User updated successfully!');

        return redirect()->route('frontend-user.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $frontendUsers = FrontendUser::findOrFail($id);
        $frontendUsers->delete();

        flash()->use('theme.ios')->success('Frontend User deleted successfully.');

        return redirect()->route('frontend-user.index');
    }
}
