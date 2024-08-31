<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\CreateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = User::orderByDesc("created_at")->paginate("20");
        return view("dashboard.pages.users.index",compact("data"));
    }

    public function create()
    {
        $roles = Role::all();
        return view('dashboard.pages.users.create', compact('roles'));
    }

    /**
     * Store a newly created user in storage.
     */
    public function store(CreateUserRequest $request)
    {

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->syncRoles($request->roles);

        return redirect()->route('users.index')->with('message', 'User created successfully.');
    }

    /**
     * Show the form for editing the specified user.
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        $userRoles = $user->roles->pluck('name')->toArray();

        return view('dashboard.pages.users.edit', compact('user', 'roles', 'userRoles'));
    }

    /**
     * Update the specified user in storage.
     */
    public function update(Request $request, User $user)
    {

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        $user->syncRoles($request->roles);

        return redirect()->route('users.index')->with('message', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        DB::beginTransaction();
        try {
            $user->delete();
            DB::commit();
            return redirect()->route('users.index')->with('message', 'User deleted successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error deleting user: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Failed to delete user']);
        }
    }
    public function show(User $user)
    {
        return view("dashboard.pages.users.show",compact("user"));
    }
    public function loginAsUser($id)
    {
        $user = User::findOrFail($id);
        if (!Auth::user()->can('login user')) {
            abort(403);
        }
        Auth::loginUsingId($id);
        return redirect()->route('dashboard')->with('success', 'You Loggined As : ' . $user->name);
    }
}
