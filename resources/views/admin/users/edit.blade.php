@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">User : {{ $user->name }}</div>

                    <div class="card-body">
                        <form action="{{ route('admin.users.update',$user) }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text"
                                           class="form-control @error('name') is-invalid @enderror"
                                           name="name" value="{{ $user->name }}" required autocomplete="name" autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email"
                                       class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                           class="form-control @error('email') is-invalid @enderror"
                                           name="email" value="{{ $user->email }}" required autocomplete="email">

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <label class="col-md-4 col-form-label text-md-right">Roles</label>
                            @foreach($roles as $role)
                                <div class="form-group row">
                                    <div class="col-md-4 offset-md-4">
                                        <div class="form-check">
                                            <input type="checkbox" name="roles[]" value="{{ $role->id }}"
                                                   @if($user->roles->pluck('id')->contains($role->id)) checked @endif>
                                            <label>{{ $role->name }}</label>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <button class="btn btn-primary justify-content-center">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
