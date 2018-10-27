@extends('layouts.main')

@section('content')
    <div class="jumbotron">
        <form method="POST" action="{{ route('edituser') }}">
            {{ csrf_field() }}

            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control smallinput" name="name" value="{{Auth::user()->name}}">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" style="width:300px;" class="form-control smallinput" name="email" value="{{Auth::user()->email}}">
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
                <button type="submit" name="edit" class="btn btn-primary">Edit</button>
            </div>

            @include('layouts.errors')
        </form>
    </div>
@endsection
