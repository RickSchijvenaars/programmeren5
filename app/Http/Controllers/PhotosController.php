<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class PhotosController extends Controller
{
    public function home(){
        $title = "Frickr";
        return view('home', compact('title'));
    }

    public function index(){
        $title = "Frickr | Photos";
        $photos = DB::table('photos')->orderBy('created_at', 'asc')->get();

        return view('photos.index', compact('photos', 'title'));
    }

    public function details($id){
        $photo= DB::table('photos')->where('id',$id)->first();
        $title = $photo->name;

        return view('photos.photodetails', compact('photo', 'title'));
    }

    public function upload(){
        $title = 'Frickr | Upload';
        return view('photos.upload', compact('title'));
    }

    public function store(){
        DB::table('photos')->insert(
            [   'name' => request('title'),
                'description' => request('description'),
                'source' => request('source')
            ]
        );

        $title = "Frickr | Photos";
        $photos = DB::table('photos')->orderBy('created_at', 'asc')->get();
        return view('photos.index', compact('title', 'photos'));
    }
}

