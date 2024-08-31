<?php

namespace App\Http\Controllers;

use App\Http\Requests\Permission\CreatePermissionRequest;
use App\Http\Requests\Permission\UpdatePermissionRequest;
use App\Http\Requests\PermissionRequest;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Log;

class PermissionController extends Controller
{
    public function index()
    {
//        if (!auth()->user()->can('view permissions')) {
//            abort(403, 'Unauthorized action.');
//        }

        $permissions = Permission::orderByDesc("created_at")->paginate(20);
        return view('dashboard.pages.permissions.index', compact('permissions'));
    }

    public function create()
    {
//        if (!auth()->user()->can('create permissions')) {
//            abort(403, 'Unauthorized action.');
//        }

        return view('dashboard.pages.permissions.create');
    }

    public function store(CreatePermissionRequest $request)
    {
//        if (!auth()->user()->can('create permissions')) {
//            abort(403, 'Unauthorized action.');
//        }

        try {
            Permission::create(['name' => $request->input('name')]);
            return redirect()->route('permissions.index')->with('message', 'Permission created successfully.');
        } catch (\Exception $e) {
            Log::error('Error creating permission: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Failed to create permission']);
        }
    }

    public function edit(Permission $permission)
    {
//        if (!auth()->user()->can('edit permissions')) {
//            abort(403, 'Unauthorized action.');
//        }

        return view('dashboard.pages.permissions.edit', compact('permission'));
    }

    public function update(UpdatePermissionRequest $request, Permission $permission)
    {
//        if (!auth()->user()->can('edit permissions')) {
//            abort(403, 'Unauthorized action.');
//        }

        try {
            $permission->update(['name' => $request->input('name')]);
            return redirect()->route('permissions.index')->with('message', 'Permission updated successfully.');
        } catch (\Exception $e) {
            Log::error('Error updating permission: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Failed to update permission']);
        }
    }

    public function destroy(Permission $permission)
    {
//        if (!auth()->user()->can('delete permissions')) {
//            abort(403, 'Unauthorized action.');
//        }

        try {
            $permission->delete();
            return redirect()->route('permissions.index')->with('message', 'Permission deleted successfully.');
        } catch (\Exception $e) {
            Log::error('Error deleting permission: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Failed to delete permission']);
        }
    }
}
