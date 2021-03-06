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

    public function __construct($company = null)
    {
        if (!empty($company)) {
            $this->cars = Car::where('company', $company)->get();
        } else {
            $this->cars = Car::all();
        }

    }

    public function getNeedServiceCars()
    {
        $cars = [];
        $diggers = [];
        $digger_service_notification_level = 10;

        foreach ($this->cars as $car) {
            try{
                $ruc = $car->needService();
                if ($ruc !== false) {
                    if ($car->vehicle_type == "Digger Vehicle") {
                        if ($ruc <= $digger_service_notification_level) {
                            $diggers[$car->plate] = $ruc;
                        }
                    } else {
                        if ($ruc < 1000) {
                            $cars[$car->plate] = $ruc;
                        }
                    }

                }
            }catch (\Exception $e){
                $cars[$car->plate] = $e->getMessage();
            }

        }
        return array(
            "cars" => $cars,
            "diggers" => $diggers
        );
    }

    public function getNeedRucCars()
    {
        $cars = [];
        foreach ($this->cars as $car) {
            if ($car->isDigger()) continue;
            try {
                $ruc = $car->needRuc();
                if ($ruc !== false) {
                    if ($ruc < 1000) {
                        $cars[$car->plate] = $ruc;
                    }
                }
            } catch (\Exception $e) {
                $cars[$car->plate] = $e->getMessage();
            }

        }
        return $cars;
    }

    public function getNeedCofCars()
    {
        $cars = [];
        foreach ($this->cars as $car) {
            if ($car->isDigger()) continue;
            $days = $car->needCof();
            if ($days < 30) {
                $cars[$car->plate] = $days;
            }
        }
        return $cars;
    }

    public function getNeedRegCars()
    {
        $cars = [];
        foreach ($this->cars as $car) {
            if ($car->isDigger()) continue;
            $days = $car->needReg();
            if ($days < 30) {
                $cars[$car->plate] = $days;
            }
        }
        return $cars;
    }
}
