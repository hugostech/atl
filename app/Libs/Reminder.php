<?php
/**
 * Created by PhpStorm.
 * User: hugo
 * Date: 1/10/18
 * Time: 3:33 PM
 */

namespace App\Libs;
use App\Car;

class Reminder
{
    public $cars;
    public function __construct($company=null)
    {
        if (!empty($company)){
            $this->cars = Car::where('company',$company)->get();
        }else{
            $this->cars = Car::all();
        }

    }

    public function getDiggerReminders(){
        $reminders = [];
        foreach ($this->cars as $car){
            $need_reminder = $car->needDiggerReminder();
            if ($need_reminder){
                $reminders[] = $car;          
            }
        }
        return $reminders;
    }

    public function getNeedServiceCars(){
        $cars = [];
        foreach ($this->cars as $car){
            $ruc = $car->needService();
            if ($ruc!==false){
                if ($ruc<1500){
                    $cars[$car->plate] = $ruc;
                }
            }
        }
        return $cars;
    }

    public function getNeedRucCars(){
        $cars = [];
        foreach ($this->cars as $car){
            try{
                $ruc = $car->needRuc();
                if ($ruc!==false){
                    if ($ruc<1500){
                        $cars[$car->plate] = $ruc;
                    }
                }
            }catch (\Exception $e){
                $cars[$car->plate] = $e->getMessage();
            }

        }
        return $cars;
    }

    public function getNeedCofCars(){
        $cars = [];
        foreach ($this->cars as $car){
            $days = $car->needCof();
            if ($days<30){
                $cars[$car->plate] = $days;
            }
        }
        return $cars;
    }

    public function getNeedRegCars(){
        $cars = [];
        foreach ($this->cars as $car){
            $days = $car->needReg();
            if ($days<30){
                $cars[$car->plate] = $days;
            }
        }
        return $cars;
    }
}