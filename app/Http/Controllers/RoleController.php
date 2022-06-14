<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;

class RoleController extends Controller
{
    public function index(){
        return view('role.index');
    }

    public function show(){
        $role = Role::all();
       return response()->json($role);
    }

    public function store(Request $request){

        $attributes = [

            'description'   => 'descripcion',
          ];
  
          $validator = $request->validate([
  
              'description'     => 'required',

          ], [], $attributes);

        $role = new Role;
        $role->description   = $request->description;

        if($role ->save()){

            return response()->json($role);
 
         } else{
 
            return response()->json( $validator);
         }

    }

    public function delete(Request $request){
        $role =Role::where('id',$request->id)->firstOrFail();
        $role->delete();
        return response()->json("succes");
    }
}
