<?php
/*
    06.06.2021
    TechnicianService.php
*/

namespace App\Services;

use GuzzleHttp\Client;
use Guzzle\Http\Exception\ClientErrorResponseException;
use Session;
use Str;


class TechnicianService{

    public static function getTechnicians(){


    	$token = Session::get('access_token');


		if($token === null){
			return redirect('login');
		}

        $access_token = 'Bearer '.$token;
  		$uuid = (string) Str::uuid();

        $resHeader =  [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'Authorization'      => $access_token
            ]
        ];

		try {

			$client = new Client();
        	$apiurl = env("END_POINT_API")."appuser/userLevel/Technician/".$uuid;
			$techRes = $client->request('GET',$apiurl , $resHeader);
			$Technicians = $techRes->getBody()->getContents();
			$Technicians =json_decode($Technicians);

            $techniciansArr = [];

			foreach ($Technicians as $key => $tech) {
			
				$arr =[
					'appUserId' => $tech->appUserId,
					
					'userId'=>$tech->userId,
					'pwd'=>$tech->pwd,
					'name' => $tech->name,
					'expAt'=>$tech->expAt,
					'levelId'=>$tech->levelId,
					'appUserTownships'=>$tech->appUserTownships,
					'appUserLevel'=>$tech->appUserLevel,
					'cat'=>$tech->cat,
					'uat'=>$tech->uat,
					'cby'=>$tech->cby,
					'uby'=>$tech->uby
				];		
				array_push($techniciansArr, $arr);
			}

            return $techniciansArr;
        }catch (ClientErrorResponseException $exception) {
		    $responseBody = $exception->getResponse()->getBody(true);

            return  $responseBody;
		}
    }

}