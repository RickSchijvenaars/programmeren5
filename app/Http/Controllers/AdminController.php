<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use App\User;
use App\Photo;
use Illuminate\Support\Facades\Auth;


class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        $title = "Admin Dashboard";
        $users = User::All();
        $photos = Photo::All();
        $categories = Category::All();

        $user =  User::where('name', $request->get('user'))->first();
        $photo =  Photo::where('id', $request->get('photo'))->first();

        return view('users.admindashboard', compact('title', 'users', 'photos', 'categories', 'user', 'photo'));
    }

    public function userUpdate($name)
    {
        $user = User::where('name',$name)->first();
            $this->validate(request(), [
                'name' => 'required|unique:users,name,',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:6|confirmed'
                ]);

        $user->name = request('name');
        $user->email = request('email');
        $user->password = bcrypt(request('password'));

        $user->save();

    }


}
