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
        $select = $request->get('category', 'All');

        $category = Category::where('name', $select)->first();

        if($select== 'All'){
            $photos = Photo::latest()->get();
        }else{
            $photos = Photo::where('category_id', $category->id)->latest()->get();
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

        $photo = $request->file('file');
        $new_name = rand() . '.' . $photo->getClientOriginalExtension();
        $photo->move(public_path("photos"), $new_name);

        $category = Category::where('name', request('category'))->first();

        Photo::insert(
            [   'name' => request('title'),
                'description' => request('description'),
                'user_id' => Auth::id(),
                'source' => $new_name,
                'category_id' => $category->id,
                'created_at' => NOW(),
            ]
        );
        return redirect()->route('gallery');
    }
}

