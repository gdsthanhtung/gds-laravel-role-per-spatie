@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Roles</h1>
    @can('create roles')
        <a href="{{ route('roles.create') }}" class="btn btn-primary">Create Role</a>
    @else
        <button class="btn btn-primary" disabled>Create Role</button>
    @endcan
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Permissions</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($roles as $role)
                <tr>
                    <td>{{ $role->id }}</td>
                    <td>{{ $role->name }}</td>
                    <td width="40%">
                        @foreach ($role->permissions as $permission)
                            <span class="badge bg-secondary">{{ $permission->name }}</span>
                        @endforeach
                    </td>
                    <td>
                        @can('view roles')
                            <a href="{{ route('roles.show', $role->id) }}" class="btn btn-info">View</a>
                        @endcan
                        @can('edit roles')
                            <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-warning">Edit</a>
                        @endcan
                        @can('delete roles')
                            <form action="{{ route('roles.destroy', $role->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        @endcan
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
