@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Users</div>

                    <div class="card-body">
                        <table class="table table-striped">
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
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
