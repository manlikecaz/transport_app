<?php

namespace App\Http\Controllers;
use \App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request){
        $fields = $request->validate([
            'name'=>'required',
            'email'=>'required|string|unique:users,email',
            'password'=>'required|string|confirmed',
             ]);

             $user = User::create([
                'name'=>$fields['name'],
                'email'=>$fields['email'],
                'password'=>bcrypt($fields['password'])
             ]);
             $token = $user->createToken('myAppToken')->plainTextToken;
             $response = [
                'user'=>$user,
                'token'=>$token,
             ];
             return response($response, 201);

}
        public function login(Request $request){
            $fields = $request->validate([
                'email'=>'required|string',
                'password'=>'required|string',
                 ]);
                 //check email exists
                 $user = User::where('email',$fields['email'])->first();
                 //check password is the same
                 if(!$user||!Hash::check($fields['password'],$user->password)){
                    return response([
                        'message'=>'Bad Credentials!'
                    ],401);
                 }
                 $token = $user->createToken('myAppToken')->plainTextToken;
                 $response = [
                    'user'=>$user,
                    'token'=>$token,
                 ];
                 return response($response,201);
        }
}

