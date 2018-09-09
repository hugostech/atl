<?php

namespace App\Http\Controllers;

use App\Car;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ruc = [];
        $cof = [];
        $service = [];
        $reg = [];

        foreach (Car::all() as $car){
            if ($car->trashed()){
                continue;
            }
            if ($car->needCof()){
                $cof[] = $car;
            }
            if ($car->needRuc()){
                $ruc[] = $car;
            }
            if ($car->needReg()){
                $reg[] = $car;
            }
            if ($car->needService()){
                $service[] = $car;
            }
        }
        return view('home', compact('service','ruc','cof','reg'));
    }
}
