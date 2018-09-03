<?php

namespace App\Http\Controllers;

use App\Car;
use Illuminate\Http\Request;

class CarController extends Controller
{
    public function list(){
        return view('car.index');
    }

    public function getCarInfo(Request $request){
        $this->validate($request, [
            'plate'=>'required'
        ]);

    }

    public function saveCar(Request $request){
        //to do
    }

    public function updateCar(Request $request){
        //to do
    }

    public function removeCar($car_id){
        $car = Car::find($car_id);
        if (!is_null($car)){
            $car->trashed();
        }
    }

    /**
     * @param $car_id
     * display car detail page
     */
    public function showCar($car_id){
        //to do
    }





}
