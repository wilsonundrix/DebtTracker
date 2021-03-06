@extends('layouts.app')

@section('link')
    <h4 class="float-left">{{ $user->name }}</h4>
    <a class="btn btn-primary float-right" href="{{ route('admin.users.index') }}">Back to Users</a>
@endsection

@section('content')
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
        <div class="justify-content-center">
            <button class="btn btn-primary">Update</button>
        </div>

    </form>
@endsection
