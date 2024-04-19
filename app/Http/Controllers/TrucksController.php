<?php

namespace App\Http\Controllers;
use App\Models\Trucks;
use Illuminate\Http\Request;

class TrucksController extends Controller
{
    public function createTruck(Request $request){
        $request->validate([
            "truckName"=>"required",
            "driverId"=>"required"
            // "truckNumber"=>"required",
            
        ]);

        $truck = Trucks::create([
            'truckName'=>$request->truckName,
            'driverId'=>$request->driverId,
            // 'truckNumber'=>$request->truckNumber,
            
        ]);

        return response()->json($truck);
    }
    public function readAllTrucks(){
        $truck = Trucks::join('drivers','trucks.driverId','=','drivers.Id')->select('trucks.*','drivers.driver_name as driver_name')->get();
        if(!$truck ->isempty()){
            return response()->json("No truck were found",404);
        }
        else {
            return response ()->json($truck);
        }
    }

    public function readTruck($id){
        try{
            $truck= Trucks ::findOrFail($id);



            if($truck){
                return response()->json($truck);
            }
            else{
                return response()->json("No truck Was Found With The ID: ",$id);
            }   
        }
        catch(\Exception $e){
            return response()->json([
                'error'=>'Unable to update record'
            ],400);
        }
    }

    public function updateTruck($id, Request $request){
        try{
            $request ->validate([
                "truckName"=>"required",
                "truckNumber"=>"required",
            ]);
            $truck = Trucks::findorFail($id);

            if($truck){
                $truck->truckName = $request ->truckName;
                $truck->truckNumber = $request ->truckNumber;
                $truck->save();
                return response()->json($truck);
            }
            else{
                return response()->json("No truck was found with ID: ",$id);
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
            $truck = Trucks::findorFail($id);
            if ($truck){
                Trucks::destroy($id);
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
