<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function profile()
    {
        $title = 'Frickr | Profile';
        return view('users.profile', compact('user', 'title'));
    }

    public function edit()
    {
        $user = Auth::user();

        if (Auth::user()->email == request('email')) {
            $this->validate(request(), [
                //'email' => 'required|email|unique:users',
                'password' => 'required|min:6|confirmed'
            ]);
        } else {
            $this->validate(request(), [
                'email' => 'required|email|unique:users',
                'password' => 'required|min:6|confirmed'
            ]);
        }

        $user->name = Auth::user()->name;
        $user->email = request('email');
        $user->password = bcrypt(request('password'));

        $user->save();

        return back();
    }
}
