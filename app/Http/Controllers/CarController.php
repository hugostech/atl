<?php

namespace App\Http\Controllers;

use App\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CarController extends Controller
{
    public function list(){
        $cars = Car::all();
        return view('car.index',compact('cars'));
    }

    public function getCarInfo(Request $request){
        $this->validate($request, [
            'plate'=>'required'
        ]);

    }

    public function newCar(){
        return view('car.new');
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

    public function updateCar($id,Request $request){
        Car::find($id)->update($request->all());
        return redirect()->route('car_edit',['id'=>$id])->with('update_success','Update Success');
    }

    public function removeCar($id){
        $car = Car::find($id);
        if (!is_null($car)){
            $car->delete();
        }
        return redirect()->route('car_list')->with('success','Delete Success');
    }

    /**
     * @param $car_id
     * display car detail page
     */
    public function showCar($car_id){
        return redirect()->route('car_edit',['id'=>$car_id]);
    }

}
