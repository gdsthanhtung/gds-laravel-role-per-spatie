<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Permission as MainModel;

use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;


class PermissionController extends Controller
{
    public function index()
    {
        $permissions = MainModel::all();
        return view('admin.permissions.index', compact('permissions'));
    }

    public function create()
    {
        return view('admin.permissions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:permissions|max:255',
        ]);

        Permission::create(['name' => Str::lower($request->name)]);

        return redirect()->route('permissions.index')->with('success', 'Permission created successfully.');
    }

    public function show($id)
    {
        $permission = MainModel::findOrFail($id);
        return view('admin.permissions.show', compact('permission'));
    }

    public function edit($id)
    {
        $permission = MainModel::findOrFail($id);
        return view('admin.permissions.edit', compact('permission'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:permissions,name,' . $id . '|max:255',
        ]);

        $permission = MainModel::findOrFail($id);
        $permission->update($request->all());

        return redirect()->route('permissions.index')->with('success', 'Permission updated successfully.');
    }

    public function destroy($id)
    {
        $permission = MainModel::findOrFail($id);
        $permission->delete();

        return redirect()->route('permissions.index')->with('success', 'Permission deleted successfully.');
    }
}
