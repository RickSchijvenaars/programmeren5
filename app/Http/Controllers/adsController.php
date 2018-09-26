<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class adsController extends Controller
{
    public function index()
    {
        $title = 'Overzicht';
        $advertisements = DB::table('advertisements')->orderBy('created_at', 'asc')->get();

        return view('welcome', compact('advertisements', 'title'));
    }


    public function details($id)
    {
        $title = 'Details';
        $advertisement = DB::table('advertisements')->where('id',$id)->first();

        return view('ad', ['advertisement' => $advertisement], compact('title'));
    }
}
