<?php
/*
    06.06.2021
    TownshipService.php
*/

namespace App\Services;

use GuzzleHttp\Client;
use Guzzle\Http\Exception\ClientErrorResponseException;
use Session;
use Str;


class TownshipService{

    public static function getTownships(){


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
        	$tshAPI = env("END_POINT_API")."township/".$uuid;
			$tshRes = $client->request('GET',$tshAPI , $resHeader);
			$townships = $tshRes->getBody()->getContents();
			$townships =json_decode($townships);

            $townshipArr = [];

			foreach ($townships as $key => $township) {
			
				$arr =[
					'tS_Code' => $township->tS_Code,
					'tsh_Name' => $township->tS_Name,
				];		
				array_push($townshipArr, $arr);
			}

            return $townshipArr;
        }catch (ClientErrorResponseException $exception) {
		    $responseBody = $exception->getResponse()->getBody(true);

            return  $responseBody;
		}
    }

}