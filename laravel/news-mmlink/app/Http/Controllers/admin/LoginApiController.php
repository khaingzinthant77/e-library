<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Guzzle\Http\Exception\ClientErrorResponseException;
use App\Models\ActionLog;
use Carbon\Carbon;

class LoginApiController extends Controller
{

	public function otpPassword(){
		return view('auth.otp');
	}

	public function loginrequest(Request $request)
    {
    	try {

			$client = new Client();
			$userId = $request->loginId;
           	$headersBody =  [
			    'headers' => [
			        'Accept' => 'application/json',
	            	'Content-Type' => 'application/json'
			    ],
			    'body' => json_encode(
				        [
				            'userId' => $request->loginId,
				        ]
				    )
			  ];

	        $loginrequest =  env("END_POINT_API").'appuser/loginrequest';

	        $response = $client->request('post',$loginrequest , $headersBody);

			$responsedata = $response->getBody()->getContents();
			$data =json_decode($responsedata);
			
			if($data->responseCode == 1){


				return redirect()->route('otpPassword')->with(['userId'=>$userId]);
			}else{
				return redirect()->back()->with(['message'=>$data->responseMessage]);
			}

		}catch (Exception $exception) {
		    $responseBody = $exception->getResponse()->getBody(true);
		}
    }

    public function apiLogin(Request $request)
    {
    	try {

			$client = new Client();

			$hashpassword = sha1($request->password);


           	$headersBody =  [
			    'headers' => [
			        'Accept' => 'application/json',
	            	'Content-Type' => 'application/json'
			    ],
			    'body' => json_encode(
				        [
				            'userId' => $request->loginId,
				            'pwd' =>$hashpassword
				        ]
				    )
			  ];

	        $loginUrl =  env("END_POINT_API").'appuser/login';
	        $response = $client->request('post',$loginUrl , $headersBody);

			$responsedata = $response->getBody()->getContents();
			$data =json_decode($responsedata);

			if($data->responseCode == 1){
				session([
					'access_token'=>$data->result->access_token, 
					'appUserId'=>$data->result->appUserId, 
					'user_id'=>$data->result->user_id, 
					'user_name'=>$data->result->user_name,
					'user_level'=>$data->result->user_level,
					'token_type' => $data->result->token_type
				]);

				$arr = [
					'login_id'=>$data->result->user_id,
					'user_name'=>$data->result->user_name,
					'login_date'=>Carbon::now()->toDateTimeString(),
					'user_level'=>$data->result->user_level
				];

				$action_logs = ActionLog::create($arr);
				// if( $data->result->user_level === "Administrator" || $data->result->user_level === "Manager"){
					return redirect()->route('news');
				// }else{
				// 	return redirect()->back()->with(['message'=>'You are not authorized!']);
				// }
				
			}else{
				return redirect()->back()->with(['message'=>$data->responseMessage,'userId'=>$request->loginId]);
			}

		}catch (Exception $exception) {
		    $responseBody = $exception->getResponse()->getBody(true);
		}

    }

	public function logout(Request $request)
    {

        $request->session()->invalidate();

        $request->session()->regenerateToken();

      
        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect('/login');
    }
}
