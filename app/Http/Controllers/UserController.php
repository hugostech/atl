<?php

namespace App\Http\Controllers;

use App\Car;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function list(){
        $users = User::all();
        return view('user.index',compact('users'));
    }

    public function newUser(){
        return view('user.register');
    }

    public function removeUser($id){
        $user = User::find($id);
        if (!is_null($user)){
            $user->delete();
        }
        return redirect()->route('user_list')->with('success','Delete Success');
    }
}
