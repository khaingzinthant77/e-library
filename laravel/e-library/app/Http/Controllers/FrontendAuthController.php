<?php

namespace App\Http\Controllers;

use App\User;
use App\Author;
use App\Category;
use App\Slider;
use App\Rating;
use Hash;
use Auth;

use Illuminate\Http\Request;

class FrontendAuthController extends Controller
{
	public function register(Request $request)
	{
        // dd($request->all());
		$this->validate($request, [
            'username' => 'required',
            'ph_no'=>'required',
            'password' => 'required|confirmed|min:6'
        ]);

		$members = User::create([
   			'name'=>$request->username,
   			'ph_no'=>$request->ph_no,
   			'email'=>$request->email,
   			'status'=>1,
   			'password'=>Hash::make($request->password)
   		]);
        $members->assignRole("Member");

        $fieldType = filter_var($request->email, FILTER_VALIDATE_EMAIL) ? 'email' : 'ph_no';
        
        if(auth()->attempt(array('ph_no' =>$request->ph_no, 'password' => $request->password)))

        {
            return redirect()->route('member_ebooks');
            
        }

	}

    public function sign_in(Request $request)
    {
        // dd($request->all());
        if(auth()->attempt(array('ph_no' =>$request->ph_no, 'password' => $request->password)))

        {
            return redirect()->route('member_ebooks');
            
        }else{
            return redirect()->route('sign_in')

                ->with('error','Phone And Password Are Wrong.');
        }

    }

    public function logout()
    { 
        Auth::logout();
        return redirect()->route('frontend_home');
    }
}