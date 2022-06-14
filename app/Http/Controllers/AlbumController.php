<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Album;

class AlbumController extends Controller
{
    public function index(){
        return view('album.index');
    }

    public function store(Request $request){

        $attributes = [
            'title'              => 'titulo',
            'description'  => 'descripcion',
          ];
  
          $validator = $request->validate([
  
              'title'     => 'required',
              'description' => 'required',
  
          ], [], $attributes);

        $album = new Album;
        $album->title          = $request->title;
        $album->description  = $request->description;

          if($album->save()){

              return response()->json($album);

            } else{

             return response()->json( $validator);
        }
        }
}
