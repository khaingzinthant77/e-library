<?php
/*
    06.06.2021
   TicketIssueProblemService.php
*/

namespace App\Services;

use GuzzleHttp\Client;
use Guzzle\Http\Exception\ClientErrorResponseException;
use Session;
use Str;


class TicketIssueProblemService{

    public static function getProblems(){


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
        	$apiurl = env("END_POINT_API")."ticketproblem/".$uuid;
			$res = $client->request('GET',$apiurl , $resHeader);
			$problem = $res->getBody()->getContents();
			$problem =json_decode($problem);

            $problemArr = [];

			foreach ($problem as $key => $issue) {
				$arr =[
					'name' => $issue->name,
                    'ticketProblemId'=>$issue->ticketProblemId
				];		
				array_push($problemArr, $arr);
			}

            return $problemArr;
        }catch (ClientErrorResponseException $exception) {
		    $responseBody = $exception->getResponse()->getBody(true);

            return  $responseBody;
		}
    }

}