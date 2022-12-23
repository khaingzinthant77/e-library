<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController as BaseController;
use App\Models\Token;
use App\Models\Rating;
use Validator;
use Log;

class TokenApiController extends BaseController
{
	public function token_create(Request $request)
	{
		// dd("Here");
		$input = $request->all();
             $rules=[
                'user_id' => 'required',
                'user_name'=>'required',
                'token'=>'required'
            ];

            $validator = Validator::make($input, $rules);

             if ($validator->fails()) {
                $messages = $validator->messages();
                   return response()->json(['message'=>"Error",'status'=>0]);
            }else{
               $token = Token::where('user_id',$request->user_id)->orderBy('id','desc')->get();
               // dd($token);
               if(count($token)>0){
                   if ($token[0]->user_id === $request->user_id) {
                  // dd('hello');
                  $token = Token::find($token[0]->id);
                  $token = $token->update([
                     'token'=>$request->token,
                  ]);
               }else{
                  // dd('hello');
                  $token = Token::create([
                     'user_id'=>$request->user_id,
                     'user_name'=>$request->user_name,
                     'township_name'=>$request->township_name,
                     'token'=>$request->token,
                  ]);
               }
            } else{
               $token = Token::create([
                     'user_id'=>$request->user_id,
                     'user_name'=>$request->user_name,
                     'township_name'=>$request->township_name,
                     'token'=>$request->token,
                  ]);
            } 
              
            	
            	return response()->json(['message'=>"Success",'status'=>1]);
            }
	}

   public function rating(Request $request)
   {
      $input = $request->all();
           $rules=[
                'cust_name'=>'required',
                'rating_count'=>'required',
                'phone_no'=>'required'
          ];
         $validator = Validator::make($input, $rules);
         $response = array('response' => '', 'success'=>false);
          if ($validator->fails()) {
             $messages = $validator->messages();
                 $response['response'] = $validator->messages()->first();
                 return $response;
         }else{
            $rating = Rating::create([
               'cust_name'=> $request->cust_name,
               'rating_count'=>$request->rating_count,
               'description'=>$request->description,
               'phone_no'=>$request->phone_no
            ]);
            return response()->json(['message'=>"Thank you for your rating 😄",'status'=>1]);
         }
   }
}