<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PhotosController extends Controller
{
    public function home(){
        $title = "Frickr";
        return view('home', compact('title'));
    }

    public function index(Request $request){
        $title = "Frickr | Photos";
        $category = $request->get('category', 'All');

        if($category == 'All'){
            $photos = DB::table('photos')->orderBy('created_at', 'asc')->get();
        }else{
            $photos = DB::table('photos')->where('category', $category)->orderBy('created_at', 'asc')->get();
        }

        $categories = DB::table('categories')->get();

        return view('photos.index', compact('categories', 'photos', 'title'));
    }

    public function details($id){
        $photo= DB::table('photos')->where('id',$id)->first();
        $title = $photo->name;

        return view('photos.photodetails', compact('photo', 'title'));
    }

    public function upload(){
        $title = 'Frickr | Upload';
        $categories = DB::table('categories')->get();

        return view('photos.upload', compact('categories', 'title'));
    }

    public function store(){

        $this->validate(request(), [
            'title' => 'required',
            'description' => 'required',
            'source' => 'required|image',
            'category' => 'required|exists:categories,name'
        ]);

        DB::table('photos')->insert(
            [   'name' => request('title'),
                'description' => request('description'),
                'source' => request('source'),
                'category' => request('category')
            ]
        );
        return redirect()->action('PhotosController@index');
    }
}

