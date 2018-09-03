<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CarController extends Controller
{
    public function list(){
        return 'all cars';
    }

    public function getCarInfo(Request $request){
        $this->validate($request, [
            'plate'=>'required'
        ]);

    }


}
