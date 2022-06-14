<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Photo;
use App\Comment;

class CommentController extends Controller
{
    public function index(){
        return view('comment..index');
    }

    public function show_img(){
        $photo = Photo::all();
        return response()->json($photo);
    }

    public function store(Request $request){

        $validator = $request->validate([

            'photo_id' => 'required',
            'postdate' => 'required',
            'content'=> 'required',
           
        ]);

        $comment = new Comment;
        $comment->photo_id     = $request->photo_id;
        $comment->postdate     = $request->postdate;
        $comment->content      = $request->content;

        if($comment->save()){

            return response()->json($comment);
 
         } else{
 
            return response()->json( $validator);
         }

    }
}
