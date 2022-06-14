<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;
use App\Member;
use App\Role;

class MemberController extends Controller
{
    public function index(){
        return view('member.index');
    }

    public function select_rol(){
        $role = Role::all();
        return response()->json( $role);
    }

    public function store(Request $request){

        $validator = $request->validate([

            'role_id' => 'required',
            'name' => 'required',
            'email'=> 'required|unique:users',
            'phonenum'=> 'required|min:6|numeric',
            'address'=> 'required',
            'password'=> 'required|min:8',
        ]);

        $member = new Member;
        $member ->role_id         = $request->role_id;
        $member ->name           = $request->name;
        $member ->email           = $request->email;        
        $member ->phonenum  = $request->phonenum;
        $member ->address       = $request->address;
        $member ->password    = bcrypt($request->password);

        if($member->save()){

            return response()->json([ 'status'=>'success']);

        } else{

            return response()->json(['error' => $validator]);
        }   

    }
}
