<?php

namespace App\Http\Controllers;
use App\Models\Driver;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    public function createDriver(Request $request){
    $request->validate([
        "driverName"=>"required",
        "driverNumber"=>"required",
        "driverEmail"=>"required"
        
    ]);

    $driver = Driver::create([
        'driverName'=>$request->driverName,
        'driverNumber'=>$request->driverNumber,
        'driverEmail'=>$request->driverEmail
    ]);

    return response()->json($driver);
}

public function readAllDrivers(){
    $drivers = Driver::all();
    if(!$ $drivers  ->isempty()){
        return response()->json("No driver was found",404);
    }
    else {
        return response ()->json($drivers);
    }
}

public function readDriver($id){
    try{
        $driver = Driver::findOrFail($id);



        if($driver){
            return response()->json($driver);
        }
        else{
            return response()->json("No driver Was Found With The ID: ",$id);
        }   
    }
    catch(\Exception $e){
        return response()->json([
            'error'=>'Unable to update record'
        ],400);
    }
}

public function updateDriver($id, Request $request){
    try{
        $request ->validate([
            
            'driverName'=>'required',
           'driverNumber'=>'required',
            'driverEmail'=>'required'
        ]);
        $driver = Driver::findorFail($id);

        if($driver){
            $driver->driverName = $request ->driverName;
            $driver->driverNumber = $request ->driverNumber ;
            $driver->driverEmail = $request ->driverEmail;
            $driver->save();
            return response()->json($driver);
        }
        else{
            return response()->json("No driver was found with ID: ",$id);
        }
    }
    catch(\Exception $e){
        return response()->json([
            'error'=>'Unable to update record'
        ],400);
    }
}


public function deleteDriver($id){
    try{
        $driver = Driver::findorFail($id);
        if ($driver){
            Driver::destroy($id);
            return response()->json("Record has been successfuly deleted ");
        }
        else{
            return response()->json("Record does not exist");
        }
    }
    catch(\Exception $e){
        return response()->json([
            'error'=>'Unable to update record'
        ],400);
    }
}
}
