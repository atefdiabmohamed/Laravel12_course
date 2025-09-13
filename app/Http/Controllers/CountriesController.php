<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCountry;
use App\Models\countries;
use Illuminate\Http\Request;

class CountriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data=countries::all();
        return view('countries',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('create_country');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateCountry $request)
    {

           $Country = new countries();
        $Country->name = $request->name;
        $Country->save();
        return redirect()->route('country.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
   $data=countries::find($id);
return view('edit_country',['data'=>$data]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $DataToUpdate['name'] = $request->name;
        countries::where("id", "=", $id)->update($DataToUpdate);
        return redirect()->route('country.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         countries::where("id", "=", $id)->delete();
        return redirect()->route('country.index');
    }
}
