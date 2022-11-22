<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Ebook;
use Validator;
use Hash;
use Hashids\Hashids;

class AuthApiController extends Controller
{
	public function sign_up(Request $request)
	{
		$input = $request->all();
	    $rules=[
            'name'=>'required',
            'phone_no'=>'required',
            'password'=>'required',
	    ];
	      $validator = Validator::make($input, $rules);
	      $response = array('response' => '', 'success'=>false);
	       if ($validator->fails()) {
	              return response(['message'=>$validator->messages()->first(),'status'=>0]);
	      }else{
	      	$members = User::create([
	      		'name'=>$request->name,
	   			'ph_no'=>$request->phone_no,
	   			'status'=>1,
	   			'password'=>Hash::make($request->password)
	      	]);
	      	return response(['message'=>"Success",'status'=>1,'user'=>$members]);
	      }
	}

	public function login(Request $request)
	{
		// dd
		$loginData = $request->validate([
            'ph_no' => 'required',
            'password' => 'required'
        ]);
 
        // dd($loginData);
        if (!auth()->attempt($loginData)) {
            return response(['message' => 'User name or password is invalid','status'=>0]);
        }else{
        	$user = auth()->user();
        	
        	$hashids = new Hashids('', 10); // pad to length 10
           	$hashids = $hashids->encodeHex($user->id);
           
           	$user->hash_id = $hashids;
        	return response(['user' => $user,'message'=>"Successfully login",'status'=>1]);
        }
	}
}