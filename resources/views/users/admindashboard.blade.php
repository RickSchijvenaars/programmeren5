@extends('layouts.main')

@section('content')
    <div class="jumbotron">
        <form method="GET">
            <div class="form-group">
                <label for="user">Users:</label>
                <select class="form-control selectcategory smallinput" id="exampleFormControlSelect1" name="user">
                    @foreach($users as $selectuser )
                        <option>{{$selectuser->name}}</option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-primary">Go</button>
            </div>
        </form>

        <form method="GET">
            <div class="form-group">
                <label for="photo">Photos:</label>
                <select class="form-control selectcategory smallinput" id="exampleFormControlSelect1" name="photo">
                    @foreach($photos as $selectphoto )
                        <option>{{$selectphoto->id}}</option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-primary">Go</button>
            </div>
        </form>
        <hr>

        @if(Request::get('user'))
            <h1>Edit:</h1>
            <form method="POST" action="{{ route('userupdate', ['user'=>$user->name])}}">
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

        @elseif(Request::get('photo'))

        <form method="POST" action="{{ route('photoupdate', ['photo'=>$photo->id]) }}" enctype="multipart/form-data">
            {{ csrf_field() }}

            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control smallinput" id="title" name="title" value="{{$photo->name}}" >
            </div>
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Description</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="4" name="description" >{{$photo->description}}</textarea>
            </div>
            <label for="exampleFormControlFile1">Category</label>
            <select class="form-control smallinput" id="exampleFormControlSelect1" name="category">
                <option>{{$photo->category}}</option>
                @foreach($categories as $category )
                    <option>{{$category->name}}</option>
                @endforeach
            </select>
            <div class="form-group">
                <label for="exampleFormControlFile1">Photo upload</label>
                <input type="file" class="form-control-file" id="exampleFormControlFile1" name="file">
            </div>

            <div class="form-group">
                <button type="submit" name="update" class="btn btn-primary">Update</button>
            </div>

            @include('layouts.errors')
        </form>
        @endif
    </div>
@endsection
