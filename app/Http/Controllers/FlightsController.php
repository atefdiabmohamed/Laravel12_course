<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Flight;
use App\Http\Requests\CreateFlightRequest;
use Illuminate\Support\Facades\DB;

class FlightsController extends Controller
{
    public function index()
    {
     $data = Flight::withTrashed()->with('destenation')->with('booking')->orderby('id','ASC')->get();

        return view('Flights', ['data' => $data]);

           /* if(!empty($data)){
        foreach($data as $info){
        $theBooking=$info->booking;
        if(!empty($info->booking)){
            foreach($info->booking as $book){
                echo $book->traveler_name;
                echo $book->flight->name;
            }
        }
        }
    }*/

        //$sum=Flight::withTrashed()->where('active','=',1)->sum('active');
   //$counter=Flight::count();

    //  $data = Flight::withTrashed()->orderby('id','DESC')->get();
        // $data = Flight::where('id','=',2)->orWhere('active','=',0)-> orderby('id','DESC')->get();
      //  $data=DB::table('flights')->orderBy('id','DESC')->get();
      //  $data = Flight::withTrashed()->active()->orderby('id','DESC')->get();
    }
    public function create()
    {

        return view('create_flight');
    }
    public function store(CreateFlightRequest $request)
    {
        /*
   $validated =$request->validate([
   'name'=>'required'
   ]);
   */



        /*
        $dataToInsert =
            [
                'name' => $request->name,
                'created_at' => date('Y-m-d H:i:s')

            ];
        Flight::create($dataToInsert);
*/
        /*
$dataToInsert['name']=$request->name;
$dataToInsert['created_at']=$request->created_at;
 Flight::create($dataToInsert);
*/
        $flight = new Flight();
        $flight->name = $request->name;
        $flight->notes = $request->notes;
        $flight->save();
        return redirect()->route('flights');
    }

    public function edit($id)
    {
        $data = Flight::findOrFail($id);
        return view('edit_flights', ['data' => $data]);
    }
    public function update_flights($id, CreateFlightRequest $request)
    {
        /* $flight  = Flight::find($id);
       $flight ->name=$request->name;
       $flight ->save();*/
        $DataToUpdate['name'] = $request->name;
        Flight::where("id", "=", $id)->update($DataToUpdate);
        return redirect()->route('flights');
    }
    public function delete_flights($id)
    {
        /*$flight= Flight::find($id);
$flight->delete();
*/
        Flight::where("id", "=", $id)->forceDelete();
        return redirect()->route('flights');
    }

      public function delete_soft($id)
    {

        Flight::where("id", "=", $id)->delete();
        return redirect()->route('flights');
    }
    public function restore($id)
    {

        Flight::where("id", "=", $id)->restore();
        return redirect()->route('flights');
    }
}
