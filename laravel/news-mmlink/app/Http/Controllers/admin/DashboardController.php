<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Guzzle\Http\Exception\ClientErrorResponseException;
use Session;
use Str;
use DateTime;
use Carbon\Carbon;
use App\Services\TownshipService;
use App\Services\TechnicianService;

class DashboardController extends Controller
{
    public function mainDashboard()
    {
		$today = date('Y-m-d');
		$date = Carbon::createFromFormat('Y-m-d', $today)
                        ->firstOfMonth()
                        ->format('Y-m-d');
		$start = isset($request->start)?$request->start:$today;
    	$end =  isset($request->end)?$request->end:date('Y-m-d');

    	$tsh_id = isset($request->tsh_id)?$request->tsh_id : null;
		$townships = TownshipService::getTownships();

		$tech_id = isset($request->tech_id)?$request->tech_id : null;
		$technicians = TechnicianService::getTechnicians();

    	$start =$start."T00:00:00.000Z";
    	$end = $end."T23:59:59.000Z";

		$token = Session::get('access_token');

		if($token === null){
			return redirect('login');
		}
		$access_token = 'Bearer '.$token;

		

		$periodJson = json_encode(
    		[
        		"periodID"=> 9, 
    			"periodName"=> "Select date", 
    			"startDate"=> $start,
    			"endDate"=>   $end
    		]
    	);


		//all ticket API
		$headersBody =  [
	    'headers' => [
	        'Accept' => 'application/json',
        	'Content-Type' => 'application/json',
	        'Authorization'      => $access_token
	    ],
	    'body' => json_encode(
		        [
		        	"cusId"=>null,
		        	// "period" => json_decode($periodJson),
		        	"status"=>null
		        ]
		    )
		];

		$client = new Client();
		$ticketURL = env("END_POINT_API")."ticket/ticketStatus";

		$ticket_response = $client->request('POST',$ticketURL , $headersBody);
		$ticket_data = $ticket_response->getBody()->getContents();
		$alltickets =json_decode($ticket_data);


		//Main ticket solved API
		$solvedheadersBody =  [
	    'headers' => [
	        'Accept' => 'application/json',
        	'Content-Type' => 'application/json',
	        'Authorization'      => $access_token
	    ],
	    'body' => json_encode(
		        [
		        	"cusId"=>null,
		        	// "period" => json_decode($periodJson),
		        	"status"=>"solve",
		        ]
		    )
		];

		$tickets_solve_response = $client->request('POST',$ticketURL , $solvedheadersBody);
		$tickets_solve_data = $tickets_solve_response->getBody()->getContents();
		$tickets_solve =json_decode($tickets_solve_data);



		 //get app user for technician

		// $ticketArr = [];
		// foreach ($alltickets as $key => $ticket) {
		// 	if ($ticket->tS_Code == 'MMR018001') {
		// 		array_push($ticketArr, $ticket);
		// 	}
		// }

		// dd($ticketArr);

		return view('dashboard.dashboards.maindashboard',compact('alltickets','townships','tickets_solve'));
	}

	public function tshDashboard($tshCode)
	{
		$start = isset($request->start)?$request->start:'1977-01-01';
    	$end =  isset($request->end)?$request->end:date('Y-m-d');

    	$start =$start."T00:00:00.000Z";
    	$end = $end."T23:59:59.000Z";

		$token = Session::get('access_token');

		if($token === null){
			return redirect('login');
		}
		$access_token = 'Bearer '.$token;

		

		$periodJson = json_encode(
    		[
        		"periodID"=> 9, 
    			"periodName"=> "Select date", 
    			"startDate"=> $start,
    			"endDate"=>   $end
    		]
    	);

		//all ticket API
		$headersBody =  [
	    'headers' => [
	        'Accept' => 'application/json',
        	'Content-Type' => 'application/json',
	        'Authorization'      => $access_token
	    ],
	    'body' => json_encode(
		        [
		        	"cusId"=>null,
		        	"period" => json_decode($periodJson),
		        	"status"=>null
		        ]
		    )
		];

		$client = new Client();
		$ticketURL = env("END_POINT_API")."ticket/ticketStatus";

		$ticket_response = $client->request('POST',$ticketURL , $headersBody);
		$ticket_data = $ticket_response->getBody()->getContents();
		$alltickets =json_decode($ticket_data);
		$tickets = $alltickets;
		$ticketArr = [];
		if ($tshCode != null) {
			foreach ($alltickets as $key => $ticket) {
				if ($ticket->tS_Code == $tshCode) {
					array_push($ticketArr, $ticket);
				}
			}

		}

		 //get app user for technician
		$headers =  [
			'headers' => [
				'Accept' => 'application/json',
				'Content-Type' => 'application/json',
				'Authorization'      => $access_token
			]
		];

		$uuid = \Str::uuid();
		$appuserAPI = env("END_POINT_API")."appuser/".$uuid;
		$appuserRes = $client->request('GET',$appuserAPI , $headers);
		$appuser = $appuserRes->getBody()->getContents();
		$appusers =json_decode($appuser);

		$techArr=[];
		foreach ($appusers as $key => $user) {
				if (isset($user->appUserLevel->userType) && $user->appUserLevel->userType == "Technician") 
				{
					array_push($techArr, $user);
				}
		}

		$techTshArr=[];
		if ($tshCode != null) {
			foreach ($techArr as $key => $tech) {
				if(count($tech->appUserTownships)>0)
					foreach($tech->appUserTownships as $techTsh){
						if ($techTsh->tS_Code == $tshCode) {
							array_push($techTshArr, $tech);
						}
					}
			}
		}

		$townships = TownshipService::getTownships();
		return view('dashboard.dashboards.tshdashboard',compact('tickets','ticketArr','techTshArr','townships','tshCode'));
	}

	public function engDashboard($appuserId)
   {
   		$start = isset($request->start)?$request->start:'1977-01-01';
    	$end =  isset($request->end)?$request->end:date('Y-m-d');

    	$start =$start."T00:00:00.000Z";
    	$end = $end."T23:59:59.000Z";

    	$appuserId = $appuserId;
    	
		$token = Session::get('access_token');

		if($token === null){
			return redirect('login');
		}
		$access_token = 'Bearer '.$token;

		$client = new Client();
		$endpoint = env("END_POINT_API")."form1/TechnicianDashboardDetail";


		//TechnicianDashboardDetail new ticket API
		$newheadersBody =  [
	    'headers' => [
	        'Accept' => 'application/json',
        	'Content-Type' => 'application/json',
	        'Authorization'      => $access_token
	    ],
	    'body' => json_encode(
		        [
		        	"AppUserId"=> $appuserId,
					"Status"=> "newTicket",
					"Type"=> "ticket",
		        ]
		    )
		];

	
		$tickets_assign_response = $client->request('POST',$endpoint , $newheadersBody);
		$tickets_assign_data = $tickets_assign_response->getBody()->getContents();
		$tickets_assign =json_decode($tickets_assign_data);
		uasort($tickets_assign, function($a, $b){
			$ascending = true;
			$d1 = strtotime($a->cat);
			$d2 = strtotime($b->cat);
			return $ascending ? ($d1 - $d2) : ($d2 - $d1);
		});

		//TechnicianDashboardDetail tickets_suspend API
		$suspendheadersBody =  [
	    'headers' => [
	        'Accept' => 'application/json',
        	'Content-Type' => 'application/json',
	        'Authorization'      => $access_token
	    ],
	    'body' => json_encode(
		        [
		        	"AppUserId"=> $appuserId,
					"Status"=> "suspendTicket",
					"Type"=> "ticket",
		        ]
		    )
		];

		$tickets_suspend_response = $client->request('POST',$endpoint , $suspendheadersBody);
		$tickets_suspend_data = $tickets_suspend_response->getBody()->getContents();
		$tickets_suspend =json_decode($tickets_suspend_data);
		uasort($tickets_suspend, function($a, $b){
			$ascending = false;
			$d1 = strtotime($a->cat);
			$d2 = strtotime($b->cat);
			return $ascending ? ($d1 - $d2) : ($d2 - $d1);
		});

		$today_tickets_suspend = [];
		foreach ($tickets_suspend as $key => $ticket_suspend) {
			if(date('Y-m-d',strtotime($ticket_suspend->suspendAt)) == date('Y-m-d')){
				array_push($today_tickets_suspend, $ticket_suspend);
			}
		}


		//TechnicianDashboardDetail ticket solved API
		$solvedheadersBody =  [
	    'headers' => [
	        'Accept' => 'application/json',
        	'Content-Type' => 'application/json',
	        'Authorization'      => $access_token
	    ],
	    'body' => json_encode(
		        [
		        	"AppUserId"=> $appuserId,
					"Status"=> "solveTicket",
					"Type"=> "ticket",
		        ]
		    )
		];

		$tickets_solve_response = $client->request('POST',$endpoint , $solvedheadersBody);
		$tickets_solve_data = $tickets_solve_response->getBody()->getContents();
		$tickets_solve =json_decode($tickets_solve_data);

		uasort($tickets_solve, function($a, $b){
			$ascending = false;
			$d1 = strtotime($a->cat);
			$d2 = strtotime($b->cat);
			return $ascending ? ($d1 - $d2) : ($d2 - $d1);
		});

		$today_ticket_solve = [];
		foreach ($tickets_solve as $key => $ticket_solve) {
			if(date('Y-m-d',strtotime($ticket_solve->solvedAt)) == date('Y-m-d')){
				array_push($today_ticket_solve, $ticket_solve);
			}
		}


		 //get app user for technician
		$headers =  [
			'headers' => [
				'Accept' => 'application/json',
				'Content-Type' => 'application/json',
				'Authorization'      => $access_token
			]
		];

		$uuid = \Str::uuid();
		$appuserAPI = env("END_POINT_API")."appuser/".$appuserId.'/'.$uuid;
		$appuserRes = $client->request('GET',$appuserAPI , $headers);
		$appuser = $appuserRes->getBody()->getContents();
		$appuser = json_decode($appuser);



		
		return view('dashboard.dashboards.engdashboard',compact('appuser','appuserId','tickets_assign','tickets_suspend','today_tickets_suspend','tickets_solve','today_ticket_solve','start','end'));
	}
}
