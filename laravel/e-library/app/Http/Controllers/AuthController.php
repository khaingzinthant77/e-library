<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
	public function login_submit(Request $request)
	{
		// // dd($request->all());
		// $loginData = $request->validate([
  //           'email' => 'required',
  //           'password' => 'required'
  //       ]);
 
  //       // dd($loginData);
  //       if (!auth()->attempt($loginData)) {
  //           dd("Here");
  //           return response(['message' => 'User name or password is invalid','status'=>0]);
  //       }else{
  //       	dd("Hello");
  //       	return response(['user' => $user,'message'=>"Successfully login",'status'=>1]);
  //       }
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        
        $credentials = $request->only('email', 'password');
        
        if (Auth::attempt($credentials)) {
            // dd(auth()->user());
            // $action_logs = ActionLog::create([
            //         'login_id'=>auth()->user()->loginId,
            //         'user_name'=>auth()->user()->name,
            //         'login_date'=>Carbon::now()->toDateTimeString(),
            //         'user_level'=>auth()->user()->emp_code
            //     ]);
            return redirect()->intended($this->redirectTo)
                        ->withSuccess('You have Successfully loggedin');
        }else{
            return redirect("admin/login")->with(['loginId'=>$request->loginId,'message'=>'Sorry! You have entered invalid credentials']);
        }  

	}
}