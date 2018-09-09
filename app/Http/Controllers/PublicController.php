<?php

namespace App\Http\Controllers;

use App\Car;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function updateOdometer($mark){
        $car = Car::where('sharing_mark',$mark)->first();
        if (is_null($car)){
            abort(404);
        }else{
            return view('car.updatemeter');
        }
    }

    public function saveOdometer($mark, Request $request){
        $this->validate($request, [
            'odometer_reading'=>'required',
            'name'=>'required'
        ]);
        $car = Car::where('sharing_mark',$mark)->first();
        if (is_null($car)){
            abort(404);
        }else{
            $car->mileage_histories()->create([
                'odometer_reading'=>$request->get('odometer_reading'),
                'editor'=>$request->get('name'),
                'car_id'=>$car->id
            ]);
            $car->odometer_reading = $request->get('odometer_reading');
            $car->save();
            return 'Thanks';
        }
    }
}
