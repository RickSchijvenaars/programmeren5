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
                    <input type="text" class="form-control" id="title" name="title">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Description</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="4" name="description"></textarea>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlFile1">Photo upload</label>
                    <input type="file" class="form-control-file" id="exampleFormControlFile1" name="source">
                </div>
                <button type="submit" class="btn btn-primary">Upload</button>
            </form>

        </div>
    </div>
@endsection