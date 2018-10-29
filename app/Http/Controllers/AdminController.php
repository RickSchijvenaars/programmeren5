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
    public function index()
    {
        $title = "Admin Dashboard";
        $users = User::All();
        $photos = Photo::All();
        $categories = Category::All();

        return view('users.admin.admindashboard', compact('title', 'users', 'photos', 'categories'));
    }

    public function editUser($id){

        $title = "Edit user";

        $user =  User::where('id', $id)->first();

        return view('users.admin.adminedituser', compact('title', 'user'));
    }

    public function editPhoto($id){

        $title = "Edit photo";

        $categories = Category::All();
        $photo =  Photo::where('id', $id)->first();

        return view('users.admin.admineditphoto', compact('title', 'photo', 'categories'));
    }



    public function updateUser($name)
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

    public function updatePhoto($id)
    {
        $photo = Photo::where('id',$id)->first();
        $category = Category::where('name', request('category'))->first();

        $this->validate(request(), [
            'title' => 'required',
            'description' => 'required',
            'category' => 'required|exists:categories,name'
        ]);

        $photo->name = request('title');
        $photo->description = request('description');
        $photo->category_id = $category->id;
        $photo->updated_at = NOW();

        $photo->save();

        return redirect()->route('details', ['photo' => $photo->id]);
    }

    public function addCategory(Request $request){
        $this->validate($request, [
            'category' => 'required|unique:categories,name',
        ]);

        Category::insert(
            [
                'name' => request('category'),
            ]
        );

        return back();
    }

    public function updateRole($id){
        $role = request('role');
        $user = User::where('id', $id)->first();

        if($role){
            $user->type = "admin";
        }else{
            $user->type = "default";
        }

        $user->save();

        return back();
    }

    public function deleteUser($id){
        User::where('id', $id)->delete();
        return back();
    }

    public function deletePhoto($id){
        Photo::where('id', $id)->delete();
        return back();
    }

    public function deleteCategory($id){
        Category::where('id', $id)->delete();
        return back();
    }


}
