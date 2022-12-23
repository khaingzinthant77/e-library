<?php
/*
    06.06.2021
   SiteService.php
*/

namespace App\Services;

use GuzzleHttp\Client;
use Guzzle\Http\Exception\ClientErrorResponseException;
use Session;
use Str;


class SiteService{

    public static function getSites(){


    	$token = Session::get('access_token');


		if($token === null){
			return redirect('login');
		}

        $access_token = 'Bearer '.$token;
  		$uuid = (string) Str::uuid();

        $headerBody =  [
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                    'Authorization'      => $access_token
                ],
                'body' => json_encode(
                        [
                            'sType'=> null,
                            'status'=> "u"
                        ]
                    )
            ];

		try {

			$client = new Client();
        	$apiurl = env("END_POINT_API")."site/SiteParam";
            $res = $client->request('POST',$apiurl , $headerBody);
			$sitesobj = $res->getBody()->getContents();
			$sites =json_decode($sitesobj);

            $sitesArr = [];

			foreach ($sites as $key => $site) {
               
				$arr =[
					'cPh'=> $site->cPh,
                    'iAddress'=> $site->iAddress,
                    'lat'=> $site->lat,
                    'lng'=> $site->lng,
                    'name'=>$site->name,
                    'qT_Code'=> $site->qT_Code,
                    'qT_Name'=> $site->qT_Name,
                    'siteCode'=> $site->siteCode,
                    'siteId'=> $site->siteId,
                    'status'=> $site->status,
                    'tS_Code'=>$site->tS_Code,
                    'tS_Name'=> $site->tS_Name,
				];		
				array_push($sitesArr, $arr);
			}

            return $sitesArr;
        }catch (ClientErrorResponseException $exception) {
		    $responseBody = $exception->getResponse()->getBody(true);

            return  $responseBody;
		}
    }

}