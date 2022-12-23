<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Guzzle\Http\Exception\ClientErrorResponseException;
use Session;
use Str;

class InquiryController extends Controller
{
	public function inquiryList(Request $request)
	{
		$start = isset($request->start)?$request->start:date('Y-m-d');
    	$end =  isset($request->end)?$request->end:date('Y-m-d');

    	
    	
    	$start =$start."00:00:00.000Z";
    	$end = $end."T23:59:59.000Z";

    	$start= date('Y-m-d\TH:i:s',strtotime($start));
    	$end= date('Y-m-d\TH:i:s',strtotime($end));

		// dd($start,$end);
    	$token = Session::get('access_token');



		if($token === null){
			return redirect('login');
		}

        $access_token = 'Bearer '.$token;
  		$client = new Client();
		
		$apiUrl = "https://portal.mm-link.net/api/form1/InquiryCustomer";

			$periodJson = json_encode(
		        		[
		        			"periodID"=> 9, 
		        			"periodName"=> "Select date", 
		        			"startDate"=> $start,
		        			"endDate"=>   $end
		        		]
		        	);

			$inquiryHeadersBody =  [
			    'headers' => [
			        'Accept' => 'application/json',
	            	'Content-Type' => 'application/json',
			        'Authorization'      => $access_token
			    ],
			    'body' => json_encode(
				        [
				        "periodID"=>0,
				        "periodName"=>"",
				        "startDate"=> "1970-01-01T01:30:00.000Z",
				        "TS_Code"=>null,
				        "qT_Code"=>null,
				        "status"=>"assign"
				    ]
				    )
			  ];

			$res = $client->request('POST',$apiUrl , $inquiryHeadersBody);
			$response = $res->getBody()->getContents();
			$datas =json_decode($response);

		return view('inquiry.list',compact('datas'));
	}

	public function inquriyDeatil($id)
	{
		$token = Session::get('access_token');

		if($token === null){
			return redirect('login');
		}

        $access_token = 'Bearer '.$token;
  		$uuid = (string) Str::uuid();

  		$client = new Client();

		$inquriyDeatilApi = 'https://portal.mm-link.net/api/form1/'.$id.'/'.$uuid;

		$resHeader =  [
		    'headers' => [
		        'Accept' => 'application/json',
            	'Content-Type' => 'application/json',
		        'Authorization'      => $access_token
		    ]
		  ];

		$inquiryRes = $client->request('GET',$inquriyDeatilApi , $resHeader);
		$data = $inquiryRes->getBody()->getContents();
		$data =json_decode($data);

		// dd($data);
		return view('inquiry.detail',compact('data'));
	}

	public function inquiry_list_by_township($tsh_code)
	{
		$start = isset($request->start)?$request->start:date('Y-m-d');
    	$end =  isset($request->end)?$request->end:date('Y-m-d');

    	
    	
    	$start =$start."00:00:00.000Z";
    	$end = $end."T23:59:59.000Z";

    	$start= date('Y-m-d\TH:i:s',strtotime($start));
    	$end= date('Y-m-d\TH:i:s',strtotime($end));

		// dd($start,$end);
    	$token = Session::get('access_token');



		if($token === null){
			return redirect('login');
		}

        $access_token = 'Bearer '.$token;
  		$client = new Client();
		
		$apiUrl = "https://portal.mm-link.net/api/form1/InquiryCustomer";

			$periodJson = json_encode(
		        		[
		        			"periodID"=> 9, 
		        			"periodName"=> "Select date", 
		        			"startDate"=> $start,
		        			"endDate"=>   $end
		        		]
		        	);

			$inquiryHeadersBody =  [
			    'headers' => [
			        'Accept' => 'application/json',
	            	'Content-Type' => 'application/json',
			        'Authorization'      => $access_token
			    ],
			    'body' => json_encode(
				        [
				        "periodID"=>0,
				        "periodName"=>"",
				        "startDate"=> "1970-01-01T01:30:00.000Z",
				        "TS_Code"=>$tsh_code,
				        "qT_Code"=>null,
				        "status"=>"assign"
				    ]
				    )
			  ];

			$res = $client->request('POST',$apiUrl , $inquiryHeadersBody);
			$response = $res->getBody()->getContents();
			$datas =json_decode($response);
			
		return view('inquiry.list',compact('datas'));
	}
}