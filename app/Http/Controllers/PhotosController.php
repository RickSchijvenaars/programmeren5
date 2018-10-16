<?php

namespace App\Http\Controllers;

use App\Photo;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PhotosController extends Controller
{
    public function index(Request $request){
        $title = "Frickr | Photos";
        $category = $request->get('category', 'All');

        if($category == 'All'){
            $photos = Photo::latest()->get();
        }else{
            $photos = Photo::where('category', $category)->latest()->get();
        }

        $categories = Category::all();

        return view('photos.index', compact('categories', 'photos', 'title'));
    }

    public function details($photo){
        $currentphoto = Photo::where('id',$photo)->first();
        $title = $currentphoto->name;

        return view('photos.photodetails', compact('currentphoto', 'title'));
    }

    public function upload(){
        $title = 'Frickr | Upload';
        $categories = Category::all();

        return view('photos.upload', compact('categories', 'title'));
    }

    public function store(Request $request){
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
           //'file' => 'max:8048',
            'category' => 'required|exists:categories,name'
        ]);


//dd($request->all());
//dd($request->hasFile("file"));

        /*if($request->hasFile('file')){
            $request->file("file")->store('public/photos');
        }else{
            return "fail";
        }*/

        $photo = $request->file('file');
        $new_name = rand() . '.' . $photo->getClientOriginalExtension();
        $photo->move(public_path("photos"), $new_name);

        Photo::insert(
            [   'name' => request('title'),
                'description' => request('description'),
                'user_id' => Auth::id(),
                'source' => $new_name,
                'category' => request('category'),
                'created_at' => NOW(),
            ]
        );
        return redirect()->route('gallery');
    }
}

