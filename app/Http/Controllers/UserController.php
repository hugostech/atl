<?php

namespace App\Http\Controllers;

use App\Car;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Str;
use Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function list(){
        $logged_user = Auth::user();
        if (empty($logged_user->company)) {
            $users = User::all();
        }
        else {
            $users = User::where('id', $logged_user->id)->get();
        }
        
        return view('user.index',compact('users'));
    }

    public function newUser(){
        //return view('user.register');
    }

    public function editUser($id){
        $is_admin = true;
        if (!empty(Auth::user()->company)) {
            $is_admin = false;
        }
        $user = User::find($id);
        return view('auth.edit',compact('user', 'is_admin'));
    }

    public function removeUser($id){
        $user = User::find($id);
        if (!is_null($user)){
            $user->delete();
        }
        return redirect()->route('user_list')->with('success','Delete Success');
    }

    public function updateUser($id,Request $request){            
        $data = $request->all();
        User::find($id)->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'company' => $data['company'],
        ]);
        return redirect()->route('user_edit',['id'=>$id])->with('update_success','Update Success');
    }
}
