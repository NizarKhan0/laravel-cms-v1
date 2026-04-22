<?php

namespace App\Http\Controllers\backendUser;

use App\Http\Controllers\Controller;
use App\Http\Requests\backendUser\UserRequest;
use App\Models\backendUser\BackendUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
// use Illuminate\Auth\Events\Registered;

class BackendUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $backendUsers = BackendUser::orderBy('created_at', 'desc')->paginate(10);

        return view(
            'backend-user.module.backendUser.index',
            [
                'backendUsers' => $backendUsers
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view(
            'backend-user.module.backendUser.create'
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        // Validation is automatically handled by UserRequest

        $user = BackendUser::create([
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

        flash()->use('theme.ios')->success('User created successfully!');

        return redirect()->route('backend-user.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $backendUsers = BackendUser::findOrFail($id);

        return view(
            'backend-user.module.backendUser.show',
            [
                'backendUsers' => $backendUsers
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $backendUsers = BackendUser::findOrFail($id);

        return view(
            'backend-user.module.backendUser.edit',
            [
                'backendUsers' => $backendUsers
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, $id)
    {
        $backendUsers = BackendUser::findOrFail($id);

        $data = [
            'username' => $request->username,
            'email' => $request->email,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'is_active' => $request->is_active ?? $backendUsers->is_active,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $backendUsers->update($data);

        flash()->use('theme.ios')->success('User updated successfully!');

        return redirect()->route('backend-user.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $backendUsers = BackendUser::findOrFail($id);
        $backendUsers->delete();

        flash()->use('theme.ios')->success('User deleted successfully.');

        return redirect()->route('backend-user.index');
    }
}