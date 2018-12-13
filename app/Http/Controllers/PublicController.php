<?php

namespace App\Http\Controllers;

use App\Car;
use App\Driver;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class PublicController extends Controller
{
    public function updateOdometer($mark){
        $car = Car::where('sharing_mark',$mark)->first();
        if (is_null($car)){
            abort(404);
        }else{
            $drivers = Driver::where('company',$car->company)->pluck('name', 'id')->all(); // this is for driver dropdown
            return view('car.updatemeter',compact('drivers', 'car'));
        }
    }

    public function getQRCode($mark) {
        $url = route('sharing_url',['mark'=>$mark]);

        $pngImage = QrCode::format('png')
                    ->size(300)->errorCorrection('H')
                    ->generate($url);

        return response($pngImage)->header('Content-type','image/png');

        // $url = route('sharing_url',['mark'=>$mark]);
        // return QrCode::size(300)->generate($url);
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
                'car_id'=>$car->id,
                'driver_id'=>$request->get('driver_id'),
                'date'=>$request->get('date'),
                'group_code'=>$request->get('group_code'),
                'cof_due_date'=>$request->get('cof_due_date'),
                'cof'=>$request->get('cof'),
                'total_fuel'=>$request->get('total_fuel'),                
                'hubmeter_reading'=>$request->get('hubmeter_reading'),
                'body'=>$request->get('body'),
                'mechanics'=>$request->get('mechanics'),
                'hygiene'=>$request->get('hygiene')
            ]);
            $car->odometer_reading = $request->get('odometer_reading');
            $car->save();
            return 'Thanks';
        }
    }
}
