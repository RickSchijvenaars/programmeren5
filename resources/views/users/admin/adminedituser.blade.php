@extends('layouts.main')

@section('content')
    <div class="jumbotron">

        <h1>Edit:</h1><br>
        <form method="POST" action="{{ route('userupdate', ['user' => $user->name])}}">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control smallinput" name="name" value="{{$user->name}}">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" style="width:300px;" class="form-control smallinput" name="email" value="{{$user->email}}">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="text" class="form-control smallinput" name="password" >
            </div>
            <div class="form-group">
                <label for="password_confirmation">Confirm password</label>
                <input type="text" class="form-control smallinput" name="password_confirmation" >
            </div>

            <div class="form-group">
                <button type="submit" name="update" class="btn btn-primary">Update</button>
            </div>

            @include('layouts.errors')
        </form>

    </div>
@endsection