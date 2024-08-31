<?php

namespace App\Http\Controllers;

use App\Http\Requests\Role\CreateRoleRequest;
use App\Http\Requests\Role\UpdateRoleRequest;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Log;

class RoleController extends Controller
{
    public function index()
    {
//        if (!auth()->user()->can('access roles')) {
//            abort(403, 'Unauthorized action.');
//        }

        $roles = Role::orderByDesc("created_at")->paginate(20);
        return view('dashboard.pages.roles.index', compact('roles'));
    }

    public function create()
    {
//        if (!auth()->user()->can('access roles')) {
//            abort(403, 'Unauthorized action.');
//        }

        return view('dashboard.pages.roles.create');
    }

    public function store(CreateRoleRequest $request)
    {
//        if (!auth()->user()->can('access roles')) {
//            abort(403, 'Unauthorized action.');
//        }

        try {
            Role::create(['name' => $request->input('name')]);
            return redirect()->route('roles.index')->with('message', 'Role created successfully.');
        } catch (\Exception $e) {
            Log::error('Error creating role: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Failed to create role']);
        }
    }

    public function edit(Role $role)
    {
//        if (!auth()->user()->can('access roles')) {
//            abort(403, 'Unauthorized action.');
//        }

        return view('dashboard.pages.roles.edit', compact('role'));
    }

    public function update(UpdateRoleRequest $request, Role $role)
    {
//        if (!auth()->user()->can('access roles')) {
//            abort(403, 'Unauthorized action.');
//        }

        try {
            $role->update(['name' => $request->input('name')]);
            return redirect()->route('roles.index')->with('message', 'Role updated successfully.');
        } catch (\Exception $e) {
            Log::error('Error updating role: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Failed to update role']);
        }
    }

    public function destroy(Role $role)
    {
//        if (!auth()->user()->can('access roles')) {
//            abort(403, 'Unauthorized action.');
//        }

        try {
            $role->delete();
            return redirect()->route('roles.index')->with('message', 'Role deleted successfully.');
        } catch (\Exception $e) {
            Log::error('Error deleting role: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Failed to delete role']);
        }
    }
    public function show(Role $role)
    {
        return view("dashboard.pages.roles.show",compact("role"));
    }
}
