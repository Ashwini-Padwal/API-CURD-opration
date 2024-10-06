<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserAuthController extends Controller
{
    function signup(Request $request){
        $input=$request->all();
        $input["password"]=bcrypt($input["password"]);
        $user=User::create($input);
        $success['token']=$user->createToken('myapp')->plainTextToken;
        $user['name']=$user->name;
        return ['success'=>'True','result'=>$user,'msg'=>'User Registered Successfully.'];

    }

    function login(Request $request){
        $user=User::where('email',$request->email)->first();
        if(!$user || !Hash::check($request->password,$user->password)){
            return ['result'=>"User not Found","Success"=>'false'];
        }
        $success['token']=$user->createToken('myapp')->plainTextToken;
        $success['name']=$user->name;
        return ["result"=>$success,"msg"=>'User login Successfully'];
       
    }
}
