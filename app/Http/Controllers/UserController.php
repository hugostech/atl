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
        $user = Auth::user();
        if (empty($user->company)) { //Admin user's company is empty
            if (empty(Input::get('company',null))){
                $users = User::all();
            }else{
                $users = User::where('company',Input::get('company'))->get();
            }
        } 
        else { // normal user            
            $users = User::where('company', $user->company)->get();            
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
        $update = [
            'name' => $data['name'],
            'email' => $data['email'],
            'company' => $data['company'],
        ];
        if ($data['old_password'] != sha1($data['password'])) {
            $update['password'] = Hash::make($data['password']);
        }
        User::find($id)->update($update);
        return redirect()->route('user_edit',['id'=>$id])->with('update_success','Update Success');
    }
}
