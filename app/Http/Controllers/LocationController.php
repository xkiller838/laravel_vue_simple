<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Location;

class LocationController extends Controller
{
    public function index(){
        return view('location.index');
    }

    public function store(Request $request){

        $attributes = [
            'name'        => 'nombre',
            'shortname'        => 'nombre corto',
          ];
  
          $validator = $request->validate([
  
              'name'     => 'required',
              'shortname' => 'required',
  
          ], [], $attributes);

        $location = new Location;
        $location->name          = $request->name;
        $location->shortname  = $request->shortname;

        if($location->save()){

            return response()->json($location);
 
         } else{
 
            return response()->json( $validator);
         }
    }
}
