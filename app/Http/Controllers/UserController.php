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

    public function getCarInfo(Request $request){
        $this->validate($request, [
            'plate'=>'required'
        ]);

    }

    public function newUser(){
        return view('user.register');
    }

    public function newDigger(){
        return view('car.newdigger');
    }

    public function saveCar(Request $request){
        $this->validate($request, [
            'plate'=>'required|unique:cars'
        ]);
        
        $car = Car::create($request->all());
        $car->sharing_mark = md5(Str::uuid());
        $car->save();
        return redirect()->route('car_list');
    }

    public function editCar($id){
        $car = Car::find($id);
        return view('car.edit',compact('car'));
    }

    public function editCarByPlate($plate){
        $car = Car::where('plate',$plate)->first();
        return view('car.edit',compact('car'));
    }

    public function updateCar($id,Request $request){
        Car::find($id)->update($request->all());
        return redirect()->route('car_edit',['id'=>$id])->with('update_success','Update Success');
    }

    public function removeUser($id){
        $user = User::find($id);
        if (!is_null($user)){
            $user->delete();
        }
        return redirect()->route('user_list')->with('success','Delete Success');
    }

    /**
     * @param $car_id
     * display car detail page
     */
    public function showCar($car_id){
        return redirect()->route('car_edit',['id'=>$car_id]);
    }

}
