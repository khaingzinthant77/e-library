<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Guzzle\Http\Exception\ClientErrorResponseException;
use Session;
use Str;
use App\Services\TownshipService;
use App\Services\TechnicianService;
use App\Services\TicketIssueService;
use App\Services\TicketIssueProblemService;
use App\Services\SiteService;
use App\Models\Ticket;

use Validator;
use DB;
use Carbon\Carbon;
use Route;
use DateTimeZone;
use DateTime;

class TicketController extends Controller
{
	public function index(Request $request)
	{
		$today = date('Y-m-d');
		$date = Carbon::createFromFormat('Y-m-d', $today)
                        ->firstOfMonth()
                        ->format('Y-m-d');
		$start = isset($request->start)?$request->start:date('Y-m-d');
    	$end =  isset($request->end)?$request->end:date('Y-m-d');
    	$tsh_id = isset($request->tsh_id)?$request->tsh_id : null;

		$tech_id = isset($request->tech_id)?$request->tech_id : null;
		$technicians = TechnicianService::getTechnicians();

		$srv_status = isset($request->srv_status)?$request->srv_status:null;

    	
    	$start =$start."T00:00:00.000Z";
    	$end = $end."T23:59:59.000Z";

    	// $start= date('Y-m-d\TH:i:s',strtotime($start));
    	// $end= date('Y-m-d\TH:i:s',strtotime($end));

		$token = Session::get('access_token');

		if($token === null){
			return redirect('login');
		}
		$access_token = 'Bearer '.$token;

		$townships = TownshipService::getTownships();

		$periodJson = json_encode(
    		[
        		"periodID"=> 9, 
    			"periodName"=> "Select date", 
    			"startDate"=> $start,
    			"endDate"=>   $end
    		]
    	);

		//new ticket API
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
		        	"status"=>"new",
					"sortDate"=> "voucherDate"
		        ]
		    )
		];
		$client = new Client();
		$ticketURL = env("END_POINT_API")."ticket/ticketStatus";

		$ticket_response = $client->request('POST',$ticketURL , $headersBody);
		$ticket_data = $ticket_response->getBody()->getContents();
		
		$tickets_newArr =json_decode($ticket_data);
		// dd($tickets_new);
		$tickets_new = [];
		$tempArr =[];
		if ($tsh_id != null) {
			foreach ($tickets_newArr as $key => $ticket) {
				if ($ticket->tS_Code == $tsh_id) {
					array_push($tempArr, $ticket);
				}
			}

		}else{
			$tempArr = $tickets_newArr;
		}

		$tempArr2 =[];
		if ($tech_id != null) {
			foreach ($tempArr as $key => $tmp) {
				if ($tmp->assignUserId == $tech_id) {
					array_push($tempArr2, $tmp);
				}
			}

		}else{
			$tempArr2 = $tempArr;
		}

		$tickets_new = $tempArr2;

		uasort($tickets_new, function($a, $b){
			$ascending = false;
			$d1 = strtotime($a->cat);
			$d2 = strtotime($b->cat);
			return $ascending ? ($d1 - $d2) : ($d2 - $d1);
		});
		

		$assignHeaderBody =  [
	    'headers' => [
	        'Accept' => 'application/json',
        	'Content-Type' => 'application/json',
	        'Authorization'      => $access_token
	    ],
	    'body' => json_encode(
		        [
		        	"cusId"=>null,
		        	"period" => json_decode($periodJson),
		        	"status"=>"assign",
					"sortDate"=> "assignDate"
		        ]
		    )
		];
		// dd($assignHeaderBody);
		$ticket_assign_response = $client->request('POST',$ticketURL , $assignHeaderBody);
		$ticket_assign_data = $ticket_assign_response->getBody()->getContents();
		// dd($ticket_assign_data);
		$tickets_assignArr =json_decode($ticket_assign_data);
		
		$tickets_assign = [];
		$tempArr =[];
		if ($tsh_id != null) {
			foreach ($tickets_assignArr as $key => $ticket) {
				if ($ticket->tS_Code == $tsh_id) {
					array_push($tempArr, $ticket);
				}
			}

		}else{
			$tempArr = $tickets_assignArr;
		}

		$tempArr2 =[];
		if ($tech_id != null) {
			foreach ($tempArr as $key => $tmp) {
				if ($tmp->assignUserId == $tech_id) {
					array_push($tempArr2, $tmp);
				}
			}

		}else{
			$tempArr2 = $tempArr;
		}
		$tickets_assign = $tempArr2;

		uasort($tickets_assign, function($a, $b){
			$ascending = false;
			$d1 = strtotime($a->cat);
			$d2 = strtotime($b->cat);
			return $ascending ? ($d1 - $d2) : ($d2 - $d1);
		});


		$suspendHeaderBody =  [
	    'headers' => [
	        'Accept' => 'application/json',
        	'Content-Type' => 'application/json',
	        'Authorization'      => $access_token
	    ],
	    'body' => json_encode(
		        [
		        	"cusId"=>null,
		        	"period" => json_decode($periodJson),
		        	"status"=>"suspend",
					"sortDate"=> "voucherDate"
		        ]
		    )
		];

		$ticket_suspend_response = $client->request('POST',$ticketURL , $suspendHeaderBody);
		$ticket_suspend_data = $ticket_suspend_response->getBody()->getContents();
		$tickets_suspendArr =json_decode($ticket_suspend_data);

		$tickets_suspend = [];
		$tempArr =[];
		if ($tsh_id != null) {
			foreach ($tickets_suspendArr as $key => $ticket) {
				if ($ticket->tS_Code == $tsh_id) {
					array_push($tempArr, $ticket);
				}
			}

		}else{
			$tempArr = $tickets_suspendArr;
		}

		$tempArr2 =[];
		if ($tech_id != null) {
			foreach ($tempArr as $key => $tmp) {
				if ($tmp->assignUserId == $tech_id) {
					array_push($tempArr2, $tmp);
				}
			}

		}else{
			$tempArr2 = $tempArr;
		}

		$tickets_suspend = $tempArr2;

		uasort($tickets_suspend, function($a, $b){
			$ascending = false;
			$d1 = strtotime($a->cat);
			$d2 = strtotime($b->cat);
			return $ascending ? ($d1 - $d2) : ($d2 - $d1);
		});


		$solveHeaderBody =  [
	    'headers' => [
	        'Accept' => 'application/json',
        	'Content-Type' => 'application/json',
	        'Authorization'      => $access_token
	    ],
	    'body' => json_encode(
		        [
		        	"cusId"=>null,
		        	"period" => json_decode($periodJson),
		        	"status"=>"solve",
					"sortDate"=> "voucherDate"
		        ]
		    )
		];

		$ticket_solve_response = $client->request('POST',$ticketURL , $solveHeaderBody);
		$ticket_solve_data = $ticket_solve_response->getBody()->getContents();
		$tickets_solveArr =json_decode($ticket_solve_data);

		$tickets_solve = [];
		$tempArr =[];
		if ($tsh_id != null) {
			foreach ($tickets_solveArr as $key => $ticket) {
				if ($ticket->tS_Code == $tsh_id) {
					array_push($tempArr, $ticket);
				}
			}

		}else{
			$tempArr = $tickets_solveArr;
		}

		$tempArr2 =[];
		if ($tech_id != null) {
			foreach ($tempArr as $key => $tmp) {
				if ($tmp->assignUserId == $tech_id) {
					array_push($tempArr2, $tmp);
				}
			}

		}else{
			$tempArr2 = $tempArr;
		}

		// foreach ($tempArr2 as $key => $ticket) {
		// 	if(date('Y-m-d',strtotime($ticket->solvedAt)) == date('Y-m-d')){
		// 		array_push($tickets_solve, $ticket);
		// 	}
		// }
		$tickets_solve = $tempArr2;
		uasort($tickets_solve, function($a, $b){
			$ascending = false;
			$d1 = strtotime($a->cat);
			$d2 = strtotime($b->cat);
			return $ascending ? ($d1 - $d2) : ($d2 - $d1);
		});
		// dd($tickets_assign);
		$route = Route::currentRouteName();
		if($route == "tickets.index"){
			return view('tickets.index',compact('tickets_new','tickets_assign','tickets_suspend','tickets_solve','start','end','townships','tsh_id','technicians','tech_id','srv_status'));
	
		}else{
			return view('tickets.vip',compact('tickets_new','tickets_assign','tickets_suspend','tickets_solve','start','end','townships','tsh_id','technicians','tech_id','srv_status'));
	
		}

	}

	public function newTicket(Request $request)
	{

		$today = date('Y-m-d');
		$date = Carbon::createFromFormat('Y-m-d', $today)
                        ->firstOfMonth()
                        ->format('Y-m-d');
		$start = isset($request->start)?$request->start:'1997-01-01';

    	$end =  isset($request->end)?$request->end:date('Y-m-d');
    	$tsh_id = isset($request->tsh_id)?$request->tsh_id : null;
    	
    	
    	
    	$start =$start."00:00:00.000Z";
    	$end = $end."T23:59:59.000Z";

    	$start= date('Y-m-d\TH:i:s',strtotime($start));
    	$end= date('Y-m-d\TH:i:s',strtotime($end));

		$periodJson = json_encode(
    		[
        		"periodID"=> 9, 
    			"periodName"=> "Select date", 
    			"startDate"=> $start,
    			"endDate"=>   $end
    		]
    	);

		$token = Session::get('access_token');

		if($token === null){
			return redirect('login');
		}
		$access_token = 'Bearer '.$token;

		$townships = TownshipService::getTownships();

		$headerBody =  [
			'headers' => [
				'Accept' => 'application/json',
				'Content-Type' => 'application/json',
				'Authorization'      => $access_token
			],
			'body' => json_encode(
					[
						"cusId"=>null,
						"period" => json_decode($periodJson),
						"status"=>"new"
					]
				)
			];

		$client = new Client();
		$ticketURL = env("END_POINT_API")."ticket/ticketStatus";

		$ticket_new_response = $client->request('POST',$ticketURL , $headerBody);
		$ticket_new_data = $ticket_new_response->getBody()->getContents();
		$tickets_newArr =json_decode($ticket_new_data);

		$tickets_new = [];
		if ($tsh_id != null) {
			foreach ($tickets_newArr as $key => $ticket) {
				if ($ticket->tS_Code == $tsh_id) {
					array_push($tickets_new, $ticket);
				}
			}
		}else{
			$tickets_new = $tickets_newArr;
		}

		uasort($tickets_new, function($a, $b){
			$ascending = false;
			$d1 = strtotime($a->cat);
			$d2 = strtotime($b->cat);
			return $ascending ? ($d1 - $d2) : ($d2 - $d1);
		});
		return view('tickets.new',compact('tickets_new','start','end','townships','tsh_id'));

	}

	
	public function assignTicket(Request $request)
	{
		// dd($request->all());
		$today = date('Y-m-d');
		$date = Carbon::createFromFormat('Y-m-d', $today)
                        ->firstOfMonth()
                        ->format('Y-m-d');

		$start = isset($request->start)?$request->start:'1997-01-01';
    	$end =  isset($request->end)?$request->end:date('Y-m-d');

    	$tsh_id = isset($request->tsh_id)?$request->tsh_id : null;
    	$townships = TownshipService::getTownships();

		$tech_id = isset($request->tech_id)?$request->tech_id : null;
		// dd($tech_id);
		$technicians = TechnicianService::getTechnicians();

		$srv_status = isset($request->srv_status)?$request->srv_status:null;
    	
    	$start =$start."T00:00:00.000Z";
    	$end = $end."T23:59:59.000Z";

    	// $start= date('Y-m-d\TH:i:s',strtotime($start));
    	// $end= date('Y-m-d\TH:i:s',strtotime($end));

		$periodJson = json_encode(
    		[
        		"periodID"=> 9, 
    			"periodName"=> "Select date", 
    			"startDate"=> $start,
    			"endDate"=>   $end
    		]
    	);

		$token = Session::get('access_token');

		if($token === null){
			return redirect('login');
		}
		$access_token = 'Bearer '.$token;

		
		$headerBody =  [
			'headers' => [
				'Accept' => 'application/json',
				'Content-Type' => 'application/json',
				'Authorization'      => $access_token
			],
			'body' => json_encode(
					[
						"cusId"=>null,
						"period" => json_decode($periodJson),
						"status"=>"assign",
					]
				)
			];

		$client = new Client();
		$ticketURL = env("END_POINT_API")."ticket/ticketStatus";

		$ticket_assign_response = $client->request('POST',$ticketURL , $headerBody);
		$ticket_assign_data = $ticket_assign_response->getBody()->getContents();
		$tickets_assignArr =json_decode($ticket_assign_data);

		// $tickets_assign = [];
		// if ($tsh_id != null) {
		// 	foreach ($tickets_assignArr as $key => $ticket) {
		// 		if ($ticket->tS_Code == $tsh_id) {
		// 			array_push($tickets_assign, $ticket);
		// 		}
		// 	}
		// }else{
		// 	$tickets_assign = $tickets_assignArr;
		// }

		$tempArr =[];
		if ($tsh_id != null) {
			foreach ($tickets_assignArr as $key => $ticket) {
				if ($ticket->tS_Code == $tsh_id) {
					array_push($tempArr, $ticket);
				}
			}

		}else{
			$tempArr = $tickets_assignArr;
		}
		// dd($tempArr);
		$tempArr2 =[];
		if ($tech_id != null) {
			foreach ($tempArr as $key => $tmp) {
				if ($tmp->assignUserId == $tech_id) {
					
					array_push($tempArr2, $tmp);
				}
			}

		}else{
			$tempArr2 = $tempArr;
		}

		// dd($tempArr2);
		$tickets_assign = $tempArr2;

		uasort($tickets_assign, function($a, $b){
			$ascending = true;
			$d1 = strtotime($a->cat);
			$d2 = strtotime($b->cat);
			return $ascending ? ($d1 - $d2) : ($d2 - $d1);
		});
		return view('tickets.assign',compact('tickets_assign','start','end','townships','tsh_id','technicians','tech_id','srv_status'));

	}


	
	public function solvedTicket(Request $request)
	{

		// $today = date('Y-m-d');
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

		$srv_status = isset($request->srv_status)?$request->srv_status:null;
    	
    	$start =$start."T00:00:00.000Z";
    	$end = $end."T23:59:59.000Z";
		$periodJson = json_encode(
    		[
        		"periodID"=> 9, 
    			"periodName"=> "Select date", 
    			"startDate"=> $start,
    			"endDate"=>   $end
    		]
    	);

		$token = Session::get('access_token');

		if($token === null){
			return redirect('login');
		}
		$access_token = 'Bearer '.$token;

		
		$headerBody =  [
			'headers' => [
				'Accept' => 'application/json',
				'Content-Type' => 'application/json',
				'Authorization'      => $access_token
			],
			'body' => json_encode(
					[
						"cusId"=>null,
						"period" => json_decode($periodJson),
						"sortDate" => "solveDate",
						"status"=>"solve"
					]
				)
			];
		// dd($headerBody);

		$client = new Client();
		$ticketURL = env("END_POINT_API")."ticket/ticketStatus";

		$ticket_solve_response = $client->request('POST',$ticketURL , $headerBody);
		$ticket_solve_data = $ticket_solve_response->getBody()->getContents();
		$tickets_solveArr =json_decode($ticket_solve_data);
		// dd($tickets_solveArr);

		$tickets_solve = [];

		$tempArr =[];
		if ($tsh_id != null) {
			foreach ($tickets_solveArr as $key => $ticket) {
				if ($ticket->tS_Code == $tsh_id) {
					array_push($tempArr, $ticket);
				}
			}

		}else{
			$tempArr = $tickets_solveArr;
		}

		$tempArr2 =[];
		if ($tech_id != null) {
			foreach ($tempArr as $key => $tmp) {
				if ($tmp->assignUserId == $tech_id) {
					array_push($tempArr2, $tmp);
				}
			}

		}else{
			$tempArr2 = $tempArr;
		}

		$tickets_solve = $tempArr2;
		
		uasort($tickets_solve, function($a, $b){
			$ascending = false;
			$d1 = strtotime($a->cat);
			$d2 = strtotime($b->cat);
			return $ascending ? ($d1 - $d2) : ($d2 - $d1);
		});
		return view('tickets.solved',compact('tickets_solve','start','end','townships','tsh_id','technicians','tech_id','srv_status'));

	}


	public function suspendTicket(Request $request)
	{

		$today = date('Y-m-d');
		$date = Carbon::createFromFormat('Y-m-d', $today)
                        ->firstOfMonth()
                        ->format('Y-m-d');
		$start = isset($request->start)?$request->start:'1997-01-01';

    	$end =  isset($request->end)?$request->end:date('Y-m-d');

    	$tsh_id = isset($request->tsh_id)?$request->tsh_id : null;
    	$townships = TownshipService::getTownships();

		$tech_id = isset($request->tech_id)?$request->tech_id : null;
		$technicians = TechnicianService::getTechnicians();

		$srv_status = isset($request->srv_status)?$request->srv_status:null;
    	
    	
    	$start =$start."00:00:00.000Z";
    	$end = $end."T23:59:59.000Z";

    	$start= date('Y-m-d\TH:i:s',strtotime($start));
    	$end= date('Y-m-d\TH:i:s',strtotime($end));

		$periodJson = json_encode(
    		[
        		"periodID"=> 9, 
    			"periodName"=> "Select date", 
    			"startDate"=> $start,
    			"endDate"=>   $end
    		]
    	);

		$token = Session::get('access_token');

		if($token === null){
			return redirect('login');
		}
		$access_token = 'Bearer '.$token;

		$townships = TownshipService::getTownships();

		$suspendHeaderBody =  [
			'headers' => [
				'Accept' => 'application/json',
				'Content-Type' => 'application/json',
				'Authorization'      => $access_token
			],
			'body' => json_encode(
					[
						"cusId"=>null,
						// "period" => json_decode($periodJson),
						"status"=>"suspend"
					]
				)
			];

		$client = new Client();
		$ticketURL = env("END_POINT_API")."ticket/ticketStatus";

		$ticket_suspend_response = $client->request('POST',$ticketURL , $suspendHeaderBody);
		$ticket_suspend_data = $ticket_suspend_response->getBody()->getContents();
		$tickets_suspendArr =json_decode($ticket_suspend_data);
		$tickets_suspend = [];

		$tempArr =[];
		if ($tsh_id != null) {
			foreach ($tickets_suspendArr as $key => $ticket) {
				if ($ticket->tS_Code == $tsh_id) {
					array_push($tempArr, $ticket);
				}
			}

		}else{
			$tempArr = $tickets_suspendArr;
		}

		$tempArr2 =[];
		if ($tech_id != null) {
			foreach ($tempArr as $key => $tmp) {
				if ($tmp->assignUserId == $tech_id) {
					array_push($tempArr2, $tmp);
				}
			}

		}else{
			$tempArr2 = $tempArr;
		}

		$tickets_suspend = $tempArr2;

		uasort($tickets_suspend, function($a, $b){
			$ascending = false;
			$d1 = strtotime($a->cat);
			$d2 = strtotime($b->cat);
			return $ascending ? ($d1 - $d2) : ($d2 - $d1);
		});
		return view('tickets.suspend',compact('tickets_suspend','start','end','townships','tsh_id','technicians','tech_id','srv_status'));

	}

	public function create($value='')
	{
		$townships = TownshipService::getTownships();
		$technicians = TechnicianService::getTechnicians();
		return view('tickets.create',compact('technicians','townships'));
	}

	public function store(Request $request)
	{
		//validate input
		$rules = [
            'issue_type'=>'required',
            'title'=>'required',
            'site'=>'required',
            'problem'=>'required',
            'technician'=>'required',
            'description'=>'required',
            'remark'=>'required'
        ];

       $validator = Validator::make($request->all(), $rules);
       if ($validator->passes()) {
	       		// DB::beginTransaction();
	       		// //save ticket data to portal with api
	       		// try {

	       			$start = date('Y-m-d');
			    	$end =  date('Y-m-d');

			    	
			    	
			    	$start =$start."00:00:00.000Z";
			    	$end = $end."T23:59:59.000Z";

			    	$start= date('Y-m-d\TH:i:s',strtotime($start));
			    	$end= date('Y-m-d\TH:i:s',strtotime($end));

	       			$token = Session::get('access_token');

					if($token === null){
						return redirect('login');
					}
					$access_token = 'Bearer '.$token;
					$uuid = (string) Str::uuid();
					// dd($uuid);
					$headersBody =  [
				    'headers' => [
				        'Accept' => 'application/json',
		            	'Content-Type' => 'application/json',
				        'Authorization'      => $access_token
				    ],
				    'body' => json_encode(
					        [
					             'ticketId' => $uuid,
					             'ticketIssueId'=>$request->issue_type,
					             'ticketProblemId'=>$request->problem,
					             'siteId'=>$request->site,
					             'priority'=>(Int)$request->priority,
					             'description'=>$request->description,
					             'title'=>$request->title,
					             'remark'=>$request->remark,
					             'assignUserId'=>$request->technician,
					             'adminSolved'=>false,
					             'adminSolvedAt'=>null,
					             'assignAt'=> date('Y-m-d\TH:i:s\Z'),
					             'cat'=> date('Y-m-d\TH:i:s\Z'),
							     'cby'=> "admin",
							     'solved'=> false,
							     'solvedAt'=> $start,
							     'solvedBy'=> "",
							     'suspend'=> false,
							     'suspendAt'=> null,
							     'uat'=> $start,
							     'uby'=> "admin"
					        ]
					    )
				  ];

					// dd($headersBody);
					$client = new Client();
					$ticketURL = env("END_POINT_API")."ticket";

					$ticket_response = $client->request('POST',$ticketURL , $headersBody);
					// dd($ticket_response->getBody());
					$ticket_data = $ticket_response->getBody()->getContents();
					// dd($ticket_data->statusCode);
					$tickets =json_decode($ticket_data);
					
					//if api response success save data to tickets table, if api save fail roll back with error message
					// dd($tickets->site);
					$ticket_arr = [
						'ticket_id'=>$tickets->ticketId,
						'issue_id'=>$tickets->ticketIssueType ? $tickets->ticketIssueType->ticketIssueId : "",
						'issue_name'=>$tickets->ticketIssueType? $tickets->ticketIssueType->name : "",
						'problem_id'=>$tickets->ticketProblem ? $tickets->ticketProblem->ticketProblemId : "",
						'problem_name'=>$tickets->ticketProblem ? $tickets->ticketProblem->name : "",
						'title'=>$tickets->title,
						'priority'=>(Int)$tickets->priority,
						'assign_tech_id'=>$tickets->assignUser->appUserId,
						'assign_tech_name'=>$tickets->assignUser->name,
						'assign_date'=>date('Y-m-d',strtotime($tickets->assignAt)),
						'solved_date'=>null,
						'remark'=>$tickets->remark,
						'description'=>$tickets->description,
						'is_suspend'=>0,
						'site_id'=>$tickets->site->siteId,
						'site_code'=>$tickets->site->siteCode,
						'customer_name'=>$tickets->site->customer? $tickets->site->customer->name: "",
						'customer_phone'=>$tickets->site->customer ? $tickets->site->customer->cPh : "",
						'ts_code'=>$tickets->site->customer? $tickets->site->customer->tS_Code : "",
						'ts_name'=>$tickets->site->customer->township ? $tickets->site->customer->township->tS_Name:"",
						'qt_code'=>$tickets->site->quarter ? $tickets->site->quarter->qT_Code : null,
						'qt_name'=>$tickets->site->quarter ? $tickets->site->quarter->qT_Name : null,
						'lat' => null,
						'lng' => null,
						'address'=>$tickets->site->customer->cAddress,
						'cby_id'=>$tickets->cby,
						'cby_name'=>$tickets->cby,
						'uby_id'=>$tickets->uby,
						'uby_name'=>$tickets->uby,
					];
				// dd($ticket_arr);
				$ticket = Ticket::create($ticket_arr);
				// DB::commit();
       		// } catch (Exception $e) {
       		// 	DB::rollback();
       		// 	return redirect()->route('tickets.index')->with('success','Something wrong!');
       		// }
       		
       }
       	// $route = Route::currentRouteName();
       	// // dd($route);
       	// if (condition) {
       	// 	// code...
       	// }
		return redirect()->route('tickets.index'); 

	}


	public function update(Request $request,$id)
	{
		// dd($request->all());
		// $myTicket = Ticket::findorfail($id);
		$loc_ticket = Ticket::where('ticket_id',$id)->get();
		if (count($loc_ticket)>0) {
			$myTicket = $loc_ticket->find($loc_ticket[0]->id);
		}else{
			$myTicket = null;
		}
		//validate input
		$rules = [
            'issue_type'=>'required',
            'title'=>'required',
            'site'=>'required',
            'problem'=>'required',
            // 'technician'=>'required'
        ];

       $validator = Validator::make($request->all(), $rules);
       if ($validator->passes()) {
       	// dd("Here");
	       		DB::beginTransaction();
	       		//update ticket data to portal with api
	       		try {
	       			// dd("Here");
	       			$token = Session::get('access_token');

					if($token === null){
						return redirect('login');
					}
					$access_token = 'Bearer '.$token;
					$uuid = (string) Str::uuid();
					// dd($uuid);
					$headersBody =  [
				    'headers' => [
				        'Accept' => 'application/json',
		            	'Content-Type' => 'application/json',
				        'Authorization'      => $access_token
				    ],
				    'body' => json_encode(
					        [
								"ticketId"=>$id,
								"ticketIssueId"=> $request->issue_type,
								"ticketProblemId"=>$request->problem,
								"siteId"=>$request->site,
								"title"=> $request->title,
								"description"=>  $request->description,
								"remark"=> $request->remark,
								"solved"=> false,
								"solvedAt"=> null,
								"solvedBy"=> null,
								"assignUserId"=>$request->technician,
								"priority"=> (Int)$request->priority,
								"uat" => date('Y-m-d\TH:i:s\Z'),
								"cat"=>$request->cat,
								"cby" => $request->cby,
								"uby" => null,
								"assignAt" => date('Y-m-d\TH:i:s\Z'),
								"adminSolved" => false,
								"adminSolvedAt" => null
					        ]
					    )
				  ];
				  
					$client = new Client();
					$ticketURL = env("END_POINT_API")."ticket/".$id;
					// dd($ticketURL);
					$ticket_response = $client->request('PUT',$ticketURL , $headersBody);
					// dd($ticket_response->getBody());
					$ticket_data = $ticket_response->getBody()->getContents();
					$tickets =json_decode($ticket_data);
					//if api response success save data to tickets table, if api save fail roll back with error message

					$ticket_arr = [
						'ticket_id' => $id,
						'issue_id'=>$tickets->ticketIssueType->ticketIssueId,
						'issue_name'=>$tickets->ticketIssueType->name,
						'problem_id'=>$tickets->ticketProblem->ticketProblemId,
						'problem_name'=>$tickets->ticketProblem->name,
						'title'=>$tickets->title,
						'priority'=>(Int)$tickets->priority,
						'assign_tech_id'=>($tickets->assignUser)?$tickets->assignUser->appUserId:'',
						'assign_tech_name'=>($tickets->assignUser)?$tickets->assignUser->name:'',
						'assign_date'=>date('Y-m-d H:i:s',strtotime($tickets->assignAt)),
						'solved_date'=>null,
						'remark'=>$tickets->remark,
						'description'=>$tickets->description,
						'is_suspend'=>0,
						'site_id'=>$tickets->site->siteId,
						'site_code'=>$tickets->site->siteCode,
						'customer_name'=>$tickets->site->customer->name,
						'customer_phone'=>$tickets->site->customer->cPh,
						'ts_code'=>$tickets->site->township->tS_Code,
						'ts_name'=>$tickets->site->township->tS_Name,
						'qt_code'=>$tickets->site->quarter ? $tickets->site->quarter->qT_Code : null,
						'qt_name'=>$tickets->site->quarter ? $tickets->site->quarter->qT_Name : null,
						'lat' => null,
						'lng' => null,
						'address'=>$tickets->site->customer->cAddress,
						'cby_id'=>$tickets->cby,
						'cby_name'=>$tickets->cby,
						'uby_id'=>$tickets->uby,
						'uby_name'=>$tickets->uby,
					];
			if ($myTicket != null) {
				$ticketupdres = $myTicket->update($ticket_arr);
			}
				
				DB::commit();
       		} catch (Exception $e) {
				   dd($e);
       			DB::rollback();
       			return redirect()->route('tickets.index')->with('success','Something wrong!');
       		}
       		
       }

			return redirect()->route('tickets.index'); 

	}


	public function show($ticket_id)
	{
		$ticket_id = $ticket_id;
		return view('tickets.show',compact('ticket_id'));
	}

	public function edit($ticket_id)
	{
		$token = Session::get('access_token');

		if($token === null){
			return redirect('login');
		}
		$access_token = 'Bearer '.$token;
		$uuid = (string) Str::uuid();

		$headers =  [
			    'headers' => [
			        'Accept' => 'application/json',
	            	'Content-Type' => 'application/json',
			        'Authorization'      => $access_token
			    ]
			  ];

  		$client = new Client();
  		$apiurl = env("END_POINT_API")."ticket/".$ticket_id."/".$uuid;
		$res = $client->request('GET',$apiurl , $headers);
		$response = $res->getBody()->getContents();
		$ticket = json_decode($response);

		$townships = TownshipService::getTownships();
		$technicians = TechnicianService::getTechnicians();

		$route = Route::currentRouteName();
		if($route == "tickets.edit"){
			// dd($ticket);
			return view('tickets.edit',compact('ticket','townships','technicians'));
		}else{
			return view('tickets.show',compact('ticket','townships','technicians'));
		}

	}

	public function delete($id)
	{

		$loc_ticket = Ticket::where('ticket_id',$id)->get();
		if (count($loc_ticket)>0) {
			$myTicket = $loc_ticket->find($loc_ticket[0]->id)->delete();
		}

		$token = Session::get('access_token');

		if($token === null){
			return redirect('login');
		}
		$access_token = 'Bearer '.$token;
		$uuid = (string) Str::uuid();

		$headers =  [
			    'headers' => [
			        'Accept' => 'application/json',
	            	'Content-Type' => 'application/json',
			        'Authorization'      => $access_token
			    ]
			  ];

  		$client = new Client();
  		$apiurl = env("END_POINT_API")."ticket/".$id;
  		// dd($apiurl);
		$res = $client->request('DELETE',$apiurl , $headers);
		$response = $res->getBody()->getContents();
		$ticket = json_decode($response);
		// dd($ticket);
		return redirect()->route('tickets.index');
	}

	public function getCustomerData(Request $request)
	{
		$token = Session::get('access_token');

		if($token === null){
			return redirect('login');
		}
		$access_token = 'Bearer '.$token;
		$uuid = (string) Str::uuid();

		$headers =  [
			    'headers' => [
			        'Accept' => 'application/json',
	            	'Content-Type' => 'application/json',
			        'Authorization'      => $access_token
			    ]
			  ];

  		$client = new Client();
  		$apiurl = env("END_POINT_API")."site/".$request->site_id."/".$uuid;
		$res = $client->request('GET',$apiurl , $headers);
		$response = $res->getBody()->getContents();
		
		return $response;
	}

	public function getUserId(Request $request)
	{
		$technicians = TechnicianService::getTechnicians();
		// dd($technicians);
		$tech = [];
		foreach ($technicians as $key => $technician) {
			if ($technician['appUserId'] == $request->technician) {
				array_push($tech, $technician);
			}
		}
		// dd($tech);
		return response()->json($tech);;
	}

	public function dataAjax(Request $request)
	{
		$temp_data = TechnicianService::getTechnicians();
		// dd(json_encode($temp_data));
		$tech_data = json_encode($temp_data);
		$data = $temp_data;

		if ($request->q != null) {
			// dd($request->q);
			$collection = collect(json_decode($tech_data));
			$filtered = $collection->where('name',$request->q);
			$data = $filtered->all();
		}else{
			$data = $temp_data;
		}

        return response()->json($data);

	}



	public function get_issue_type(Request $request)
	{
		$temp_data = TicketIssueService::getIssue();
		$issue_data = json_encode($temp_data);
		$data = $temp_data;

		if ($request->q != null) {
			$collection = collect(json_decode($issue_data));
			$filtered = $collection->where('name',$request->q);
			$data = $filtered->all();
		}else{
			$data = $temp_data;
		}

        return response()->json($data);
	}

	public function get_problem(Request $request)
	{
		$temp_data = TicketIssueProblemService::getProblems();
		$problem_data = json_encode($temp_data);
		$data = $temp_data;

		if ($request->q != null) {
			$collection = collect(json_decode($problem_data));
			$filtered = $collection->where('name',$request->q);
			$data = $filtered->all();
		}else{
			$data = $temp_data;
		}

        return response()->json($data);
	}

	public function get_site(Request $request)
	{
		$temp_data = SiteService::getSites();
		$site_data = json_encode($temp_data);
		// dd($site_data);
		$data = $temp_data;

		if ($request->q != null) {
			$collection = collect(json_decode($site_data));
			// dd($collection);
			$filtered = $collection->where('siteCode',$request->q);
			$data = $filtered->all();
		}else{
			$data = $temp_data;
		}

        return response()->json($data);
	}


	public function totalTicket(Request $request)
	{
		// dd($request->all());
		$today = date('Y-m-d');
		$date = Carbon::createFromFormat('Y-m-d', $today)
                        ->firstOfMonth()
                        ->format('Y-m-d');
		$start = isset($request->start)?$request->start:'1997-01-01';
    	$end =  isset($request->end)?$request->end:date('Y-m-d');

    	$tsh_id = isset($request->tsh_id)?$request->tsh_id : null;
    	$townships = TownshipService::getTownships();

		$tech_id = isset($request->tech_id)?$request->tech_id : null;
		// dd($tech_id);
		$technicians = TechnicianService::getTechnicians();

		$srv_status = isset($request->srv_status)?$request->srv_status:null;
    	
    	$start =$start."T00:00:00.000Z";
    	$end = $end."T23:59:59.000Z";

    	// $start= date('Y-m-d\TH:i:s',strtotime($start));
    	// $end= date('Y-m-d\TH:i:s',strtotime($end));

		$periodJson = json_encode(
    		[
        		"periodID"=> 9, 
    			"periodName"=> "Select date", 
    			"startDate"=> $start,
    			"endDate"=>   $end
    		]
    	);

		$token = Session::get('access_token');

		if($token === null){
			return redirect('login');
		}
		$access_token = 'Bearer '.$token;

		
		$headerBody =  [
			'headers' => [
				'Accept' => 'application/json',
				'Content-Type' => 'application/json',
				'Authorization'      => $access_token
			],
			'body' => json_encode(
					[
						"cusId"=>null,
						"period" => json_decode($periodJson),
						"status"=>null,
					]
				)
			];

		$client = new Client();
		$ticketURL = env("END_POINT_API")."ticket/ticketStatus";

		$ticket_total_response = $client->request('POST',$ticketURL , $headerBody);
		$ticket_total_data = $ticket_total_response->getBody()->getContents();
		$tickets_totalArr =json_decode($ticket_total_data);

		$tempArr =[];
		if ($tsh_id != null) {
			foreach ($tickets_totalArr as $key => $ticket) {
				if ($ticket->tS_Code == $tsh_id) {
					array_push($tempArr, $ticket);
				}
			}

		}else{
			$tempArr = $tickets_totalArr;
		}
		// dd($tempArr);
		$tempArr2 =[];
		if ($tech_id != null) {
			foreach ($tempArr as $key => $tmp) {
				if ($tmp->assignUserId == $tech_id) {
					
					array_push($tempArr2, $tmp);
				}
			}

		}else{
			$tempArr2 = $tempArr;
		}

		// dd($tempArr2);
		$tickets_total = $tempArr2;

		uasort($tickets_total, function($a, $b){
			$ascending = true;
			$d1 = strtotime($a->cat);
			$d2 = strtotime($b->cat);
			return $ascending ? ($d1 - $d2) : ($d2 - $d1);
		});
		return view('tickets.total',compact('tickets_total','start','end','townships','tsh_id','technicians','tech_id','srv_status'));
	}


}