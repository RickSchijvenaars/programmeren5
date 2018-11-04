<?php

namespace App\Http\Controllers;

use App\Photo;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Validator;



class PhotosController extends Controller
{
    public function index(Request $request){
        $title = "Frickr | Photos";
        $select = $request->get('category', 'All');
        $search = $request->get('search');

        $category = Category::where('name', $select)->first();

        $validate = Validator::make($request->all(), [
             'category' => 'exists:categories,name',
        ]);
        if($validate->fails()){
            return redirect()->route('gallery');
        }else {
            if ($select == 'All' AND $search == '') {
                $photos = Photo::with('user')->latest()->get();
            } elseif ($search != '') {
                $photos = Photo::with('user')->where('name', 'LIKE', "%$search%")
                    ->orWhere('description', 'LIKE', "%$search%")
                    ->latest()->get();
            } else {
                $photos = Photo::with('user')->where('category_id', $category->id)->latest()->get();
            }
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
            'file' => 'required|image|max:5000',
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

