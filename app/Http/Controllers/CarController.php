<?php

namespace App\Http\Controllers;

use App\Car;
use App\MileageHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CarController extends Controller
{
    public function CarBatchEdit(){
        $user = Auth::user();
        if (empty($user->company)) { //Admin user's company is empty
            if (empty(Input::get('company',null))){
                $cars = Car::all();
            } else {
                $cars = Car::where('company',Input::get('company'))->get();
            }
        }
        else { // normal user
            $cars = Car::where('company', $user->company)->get();
        }

        return view('car.bulk_edit',compact('cars'));
    }

    public function saveBatch(Request $request){
        $user = Auth::user();
        $datas = $request->json()->all();
        foreach ($datas as $data) {
            $data['last_editor'] = $user->id;
            Car::find($data['id'])->update($data);
        }
        return json_encode("success");
    }

    public function list(){
        $user = Auth::user();
        if (empty($user->company)) { //Admin user's company is empty
            if (empty(Input::get('company',null))){
                $cars = Car::withoutGlobalScope('status')->typeCar()->orderBy('status', 'desc')->get();
                $diggers = Car::withoutGlobalScope('status')->typeDigger()->orderBy('status', 'desc')->get();
            }else{
                $cars = Car::withoutGlobalScope('status')->typeCar()->where('company',Input::get('company'))->orderBy('status', 'desc')->get();
                $diggers = Car::withoutGlobalScope('status')->typeDigger()->where('company',Input::get('company'))->orderBy('status', 'desc')->get();
            }
        }
        else { // normal user
            $cars = Car::withoutGlobalScope('status')->typeCar()->where('company', $user->company)->orderBy('status', 'desc')->get();
            $diggers= Car::withoutGlobalScope('status')->typeDigger()->where('company', $user->company)->orderBy('status', 'desc')->get();
        }

        return view('car.index',compact('cars', 'diggers'));
    }

    public function history($car_id, $from='', $to=''){
        $data = DB::table('mileage_histories')
                ->join('drivers', 'drivers.id', '=', 'mileage_histories.driver_id')
                ->select('mileage_histories.*', 'drivers.name')
                ->where('mileage_histories.car_id', $car_id);
        if (!empty($from) && !empty($to)) {
            $data->whereBetween('mileage_histories.date', [$from, $to]);
        }
        $data->orderBy('mileage_histories.updated_at', 'desc');
        return $data->get();
    }

    public function getCarInfo(Request $request){
        $this->validate($request, [
            'plate'=>'required'
        ]);

    }

    public function newCar(){
        return view('car.new');
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
        $car = Car::withoutGlobalScope('status')->find($id);
        $history = $this->history($id);

        return view($car->getTemplate(true),compact('car', 'history'));
    }

    public function editCarByPlate($plate){
        $car = Car::withoutGlobalScope('status')->where('plate',$plate)->first();
        $history = $this->history($car->id);

        return view($car->getTemplate(true),compact('car', 'history'));
    }

    public function updateCar($id,Request $request){
        Car::withoutGlobalScope('status')->find($id)->update($request->all());
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

    public function updateAvatar($id, Request $request){
        if ($request->hasFile('avatar')) {
            $car = Car::withoutGlobalScope('status')->find($id);
            $filename = mb_split('/',$request->avatar->store('avatar', 'public'));
            $car->image = end($filename);
            $car->save();
            return redirect()->route('car_edit',['id'=>$id])->with('update_success','Update Success');
        }else{
            return redirect()->route('car_edit',['id'=>$id])->with('update_danger','Update Avatar Failed');
        }

    }

    public function doService()
    {

    }

}
