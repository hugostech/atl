<?php

namespace App\Http\Controllers;

use App\Driver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Str;
use Auth;

class DriverController extends Controller
{
    public function list(){
        $user = Auth::user();
        if (empty($user->company)) { //Admin user's company is empty
            if (empty(Input::get('company',null))){
                $drivers = Driver::all();
            }else{
                $drivers = Driver::where('company',Input::get('company'))->get();
            }
        } 
        else { // normal user            
            $drivers = Driver::where('company', $user->company)->get();            
        }
        
        return view('driver.index',compact('drivers'));
    }

    public function newDriver(){
        return view('driver.new');
    }

    public function editDriver($id){
        $driver = Driver::find($id);
        return view('driver.edit',compact('driver'));
    }

    public function saveDriver(Request $request){
        $this->validate($request, [
            'name'=>'required|unique:drivers'
        ]);
        
        $driver = Driver::create($request->all());
        $driver->save();
        return redirect()->route('driver_list');
    }

    public function updateDriver($id,Request $request){
        Driver::find($id)->update($request->all());
        return redirect()->route('driver_edit',['id'=>$id])->with('update_success','Update Success');
    }

    public function removeDriver($id){
        $driver = Driver::find($id);
        if (!is_null($driver)){
            $driver->delete();
        }
        return redirect()->route('driver_list')->with('success','Delete Success');
    }

}
