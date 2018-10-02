@extends('layouts.main')

@section('content')
    <div class="py-5 bg-light">
        <div class="container">
            <h1>Upload a photo</h1>

            <hr>

            <form method="POST" action="/photos">
                {{ csrf_field() }}

                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control smallinput" id="title" name="title" >
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Description</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="4" name="description" ></textarea>
                </div>
                <label for="exampleFormControlFile1">Category</label>
                <select class="form-control smallinput" id="exampleFormControlSelect1" name="category">
                    <option>Category..</option>
                    @foreach($categories as $category )
                        <option>{{$category->name}}</option>
                    @endforeach
                </select>
                <div class="form-group">
                    <label for="exampleFormControlFile1">Photo upload</label>
                    <input type="file" class="form-control-file" id="exampleFormControlFile1" name="source" >
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Upload</button>
                </div>

                @include('layouts.errors')
            </form>

        </div>
    </div>
@endsection