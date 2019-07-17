<?php

namespace App\Http\Controllers;

use App\Car;
use App\Libs\Reminder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

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
        if(!empty(Auth::user()->company)){
            return redirect()->route('home',['company'=>Auth::user()->company]);
        }

        $reminder = new Reminder(Input::get('company',null));
        $ruc = $reminder->getNeedRucCars();
        $cof = $reminder->getNeedCofCars();
        $service = $reminder->getNeedServiceCars();
        $reg = $reminder->getNeedRegCars();
        return view('home', compact('service','ruc','cof','reg'));
    }
}
