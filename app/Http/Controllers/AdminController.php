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
        $this->middleware('admin');
    }
    public function index(Request $request)
    {
        $title = "Admin Dashboard";
        $users = User::All();
        $photos = Photo::All();
        $categories = Category::All();

        return view('users.admin.admindashboard', compact('title', 'users', 'photos', 'categories', 'user', 'photo'));
    }

    public function edit(Request $request){
        $title = "Edit user";

        $categories = Category::All();
        $user =  User::where('id', $request->get('user'))->first();
        $photo =  Photo::where('id', $request->get('photo'))->first();

        return view('users.admin.adminedit', compact('title', 'user', 'photo', 'categories'));

    }

    public function userUpdate($name)
    {
        $user = User::where('name',$name)->first();

            $this->validate(request(), [
                'name' => 'required|unique:users,name,'.$user->id,
                'email' => 'required|email|unique:users,email,'.$user->id,
                'password' => 'required|min:6|confirmed'
                ]);

        $user->name = request('name');
        $user->email = request('email');
        $user->password = bcrypt(request('password'));
        $user->updated_at = NOW();

        $user->save();

        return back();
    }

    public function photoUpdate($id)
    {
        $photo = Photo::where('id',$id)->first();

        $this->validate(request(), [
            'title' => 'required',
            'description' => 'required',
            'category' => 'required|exists:categories,name'
        ]);

        $photo->name = request('title');
        $photo->description = request('description');
        $photo->category = request('category');
        $photo->updated_at = NOW();


        $photo->save();

        return back();
    }


}
