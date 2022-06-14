<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use App\Photo;
use App\Member;
use App\Location;
use App\Album;
use App\Tag;

class PhotoController extends Controller
{
    public function index(){
        return view('photo.index');
    }

    public function show(){
        return view('photo.show');
    }

    public function select_member(){
        $member = Member::all();
        return response()->json($member);
    }

    public function select_location(){
        $locate = Location::all();
        return response()->json($locate);
    }

    public function select_album(){
        $album =  Album::all();
        return response()->json($album);
    }

    public function store(Request $request){

        // try{
            // DB::beginTransaction();

            $validator = $request->validate([

                'album_id' => 'required',
                'location_id' => 'required',
                'member_id'=> 'required',
                'title' => 'required',
                'description' => 'required',
                'privacy' => 'required',
                'uploaddate' => 'required',
                'view'=> 'required|min:2|numeric',
                'imagepath'=> 'required|image|mimes:jpeg,png,jpg',
            ]);
    
            $etiquetas =  $request->tags;     
    
            $photo = new Photo;
            $photo ->album_id         = $request->album_id;
            $photo ->location_id      = $request->location_id;
            $photo ->member_id      = $request->member_id ;
            $photo ->user_id             = Auth::user()->id;
            $photo ->title                  = $request->title;
            $photo ->description      = $request->description;
            $photo ->privacy             = $request->privacy;
            $photo ->uploaddate      = $request->uploaddate;
            $photo ->view                 = $request->view;
            $photo ->imagepath       = $request->file('imagepath')->store('fotos');      
    
    
           foreach($etiquetas as $tag) {
    
                $etiqueta = new Tag();
                $etiqueta->title = $tag;
                $etiqueta->save();    
               }
        
            if($photo ->save()){

                $etiqueta->photos()->attach($photo->id);
    
                return response()->json([ 'status'=>'success']);
    
            }else{
    
                return response()->json(['error' => $validator]);
            }   
    
            // DB::commit();
        // } catch (Exception $e){

            // DB::rollBack();
        // }
        
    }

    public function tabla_photos(Request $request){

        $photo = Photo::with('albums', 'locations', 'members')->get();
        return response()->json($photo);

    }

}
