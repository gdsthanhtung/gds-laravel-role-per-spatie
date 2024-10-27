@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Permissions</h1>
    @can('create permissions')
        <a href="{{ route('permissions.create') }}" class="btn btn-primary">Create Permission</a>
    @else
        <button class="btn btn-primary" disabled>Create Permission</button>
    @endcan
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($permissions as $permission)
                <tr>
                    <td>{{ $permission->id }}</td>
                    <td>{{ $permission->name }}</td>
                    <td>
                        @can('view permissions')
                            <a href="{{ route('permissions.show', $permission->id) }}" class="btn btn-info">View</a>
                        @endcan
                        @can('edit permissions')
                            <a href="{{ route('permissions.edit', $permission->id) }}" class="btn btn-warning">Edit</a>
                        @endcan
                        @can('delete permissions')
                            <form action="{{ route('permissions.destroy', $permission->id) }}" method="POST" style="display:inline;">
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
