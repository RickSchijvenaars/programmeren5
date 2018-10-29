@extends('layouts.main')

@section('content')
    <div class="jumbotron">
    <h1>Edit:</h1><br>
    <img class="card-img-top" style="width:auto;max-height:200px;border:3px solid black" src="/photos/{{$photo->source}}" alt="Photo">
    <hr>
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
            <div class="form-group">
                <label for="exampleFormControlFile1">Category</label>
                <select class="form-control smallinput" id="exampleFormControlSelect1" name="category">
                    <option>{{$photo->category->name}}</option>
                    @foreach($categories as $category )
                        <option>{{$category->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <button type="submit" name="update" class="btn btn-primary">Update</button>
            </div>

            @include('layouts.errors')
        </form>
    </div>
@endsection