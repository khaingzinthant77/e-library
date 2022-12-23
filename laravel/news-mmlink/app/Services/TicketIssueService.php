<?php
/*
    06.06.2021
    TicketIssueService.php
*/

namespace App\Services;

use GuzzleHttp\Client;
use Guzzle\Http\Exception\ClientErrorResponseException;
use Session;
use Str;


class TicketIssueService{

    public static function getIssue(){


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
        	$apiurl = env("END_POINT_API")."ticketissuetype/".$uuid;
			$res = $client->request('GET',$apiurl , $resHeader);
			$issues = $res->getBody()->getContents();
			$issues =json_decode($issues);

            $issuesArr = [];

			foreach ($issues as $key => $issue) {
				$arr =[
					'issueType' => $issue->issueType,
					'name' => $issue->name,
                    'ticketIssueId'=>$issue->ticketIssueId
				];		
				array_push($issuesArr, $arr);
			}

            return $issuesArr;
        }catch (ClientErrorResponseException $exception) {
		    $responseBody = $exception->getResponse()->getBody(true);

            return  $responseBody;
		}
    }

}