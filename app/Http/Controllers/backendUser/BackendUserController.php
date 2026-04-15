<?php

namespace App\Http\Controllers\backendUser;

use App\Http\Controllers\Controller;
use App\Models\backendUser\BackendUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:backend_backend_users,email',
            'password' => 'required|min:6',
            'first_name' => 'required',
            'last_name' => 'required',
        ]);

        BackendUser::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'is_active' => $request->is_active ?? 1,
        ]);

        return redirect()->route('backend-user.index')
            ->with('success', 'User created successfully');
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
    public function update(Request $request, $id)
    {
        $backendUsers = BackendUser::findOrFail($id);

        $request->validate([
            'email' => 'required|email|unique:backend_users,email,' . $id,
            'first_name' => 'required',
            'last_name' => 'required',
        ]);

        $data = [
            'email' => $request->email,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'is_active' => $request->is_active ?? $backendUsers->is_active,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $backendUsers->update($data);

        return redirect()->route('backend-user.index')
            ->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $backendUsers = BackendUser::findOrFail($id);
        $backendUsers->delete();

        return redirect()->route('backend-user.index')
            ->with('success', 'User deleted successfully.');
    }
}
