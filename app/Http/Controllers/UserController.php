<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Photo;

class UserController extends Controller
{
    public function index(){
        return view('user.index');
    }

    public function show_user(){
        $user = User::all();
        return response()->json($user);
    }

    public function desactivar(Request $request)
    {
        /* if (!$request->ajax()) return redirect('/'); */
        $user = User::findOrFail($request->id);
        $user->estado = '0';
        $user->save();
    }

    public function activar(Request $request)
    {
        /* if (!$request->ajax()) return redirect('/'); */
        $user = User::findOrFail($request->id);
        $user->estado = '1';
        $user->save();
    }

    public function is_admin(Request $request)
    {
        /* if (!$request->ajax()) return redirect('/'); */
        $user = User::findOrFail($request->id);
        $user->is_admin = '1';
        $user->save();
    }

    public function no_admin(Request $request)
    {
        /* if (!$request->ajax()) return redirect('/'); */
        $user = User::findOrFail($request->id);
        $user->is_admin = '0';
        $user->save();
    }

    public function index_table(){
        return view('user.tabla');
    }

    public function album_user(){

     $photo = Photo::with('locations','albums','tags')->where('user_id', '=' , Auth::user()->id)->get(); 
     
    return  $photo;

    }
}
