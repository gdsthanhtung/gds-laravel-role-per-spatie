@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Users</h1>
    @can('create users')
        <a href="{{ route('users.create') }}" class="btn btn-primary">Create User</a>
    @else
        <button class="btn btn-secondary" disabled>Create User</button>
    @endcan
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Roles</th>
                <th>Permissions</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @foreach ($user->roles as $role)
                            <span class="badge bg-info">{{ $role->name }}</span>
                        @endforeach
                    </td>
                    <td>
                        @foreach ($user->permissions as $permission)
                            <span class="badge bg-secondary">{{ $permission->name }}</span>
                        @endforeach
                    </td>
                    <td>
                        @can('view users')
                            <a href="{{ route('users.show', $user->id) }}" class="btn btn-info">View</a>
                        @endcan
                        @can('edit users')
                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning">Edit</a>
                        @endcan
                        @can('delete users')
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
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
