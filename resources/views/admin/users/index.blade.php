@extends('layouts.app')

@section('link')
    <h3 class="float-left">View Users</h3>
    {{--<a class="btn btn-primary float-right" href="{{ route('admin.user.create') }}">Add New user</a>--}}
@endsection

@section('content')
    <table class="table table-striped table-bordered">
        <thead class="bg-primary">
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Roles</th>
            @can('manage-users')
                <th>Action</th>
            @endcan
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ implode(', ',$user->roles()->pluck('name')->toArray()) }}</td>
                @can('manage-users')
                    <td>
                        @can('edit-users')
                            <a class="btn btn-success float-left mr-2"
                               href="{{ route('admin.users.edit',$user->id) }}">Edit</a>
                        @endcan
                        @can('delete-users')
                            <form class="float-left" method="post"
                                  action="{{ route('admin.users.destroy',$user) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        @endcan
                    </td>
                @endcan
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection
