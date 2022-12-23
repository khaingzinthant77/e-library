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

class TicketBKController extends Controller
{
	public function index(Request $request)
	{
		$start = isset($request->start)?$request->start:date('Y-m-d');
    	$end =  isset($request->end)?$request->end:date('Y-m-d');
    	$tsh_id = isset($request->tsh_id)?$request->tsh_id : null;
    	
    	
    	$start =$start."00:00:00.000Z";
    	$end = $end."T23:59:59.000Z";

    	$start= date('Y-m-d\TH:i:s',strtotime($start));
    	$end= date('Y-m-d\TH:i:s',strtotime($end));

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
		        	"status"=>"new"
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

		if ($tsh_id != null) {
				foreach ($tickets_newArr as $key => $ticket) {
				if ($ticket->tS_Code == $tsh_id) {
					array_push($tickets_new, $ticket);
				}
			}
		}else{
			$tickets_new = $tickets_newArr;
		}
		

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
		        	"status"=>"assign"
		        ]
		    )
		];

		$ticket_assign_response = $client->request('POST',$ticketURL , $assignHeaderBody);
		$ticket_assign_data = $ticket_assign_response->getBody()->getContents();
		$tickets_assignArr =json_decode($ticket_assign_data);
		// dd($tickets_assign);
		$tickets_assign = [];

		if ($tsh_id != null) {
			foreach ($tickets_assignArr as $key => $ticket) {
				if ($ticket->tS_Code == $tsh_id) {
					array_push($tickets_assign, $ticket);
				}
			}
		}else{
			$tickets_assign = $tickets_assignArr;
		}


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
		        	"status"=>"suspend"
		        ]
		    )
		];

		$ticket_suspend_response = $client->request('POST',$ticketURL , $suspendHeaderBody);
		$ticket_suspend_data = $ticket_suspend_response->getBody()->getContents();
		$tickets_suspendArr =json_decode($ticket_suspend_data);

		$tickets_suspend = [];
		if ($tsh_id != null) {
			foreach ($tickets_suspendArr as $key => $ticket) {
				if ($ticket->tS_Code == $tsh_id) {
					array_push($tickets_suspend, $ticket);
				}
			}
		}else{
			$tickets_suspend = $tickets_suspendArr;
		}


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
		        	"status"=>"solve"
		        ]
		    )
		];

		$ticket_solve_response = $client->request('POST',$ticketURL , $solveHeaderBody);
		$ticket_solve_data = $ticket_solve_response->getBody()->getContents();
		$tickets_solveArr =json_decode($ticket_solve_data);

		$tickets_solve = [];
		if ($tsh_id != null) {
			foreach ($tickets_solveArr as $key => $ticket) {
				if ($ticket->tS_Code == $tsh_id) {
					array_push($tickets_solve, $ticket);
				}
			}

		}else{
			$tickets_solve = $tickets_solveArr;
		}

		$tickets = Ticket::get();

		return view('tickets.index',compact('tickets','tickets_new','tickets_assign','tickets_suspend','tickets_solve','start','end','townships','tsh_id'));
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
            // 'technician'=>'required'
        ];

       $validator = Validator::make($request->all(), $rules);
       if ($validator->passes()) {
	       		DB::beginTransaction();
	       		//save ticket data to portal with api
	       		try {

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
					             'assignAt'=> null,
					             'cat'=> date('Y-m-d\TH:i:s\Z'),
							     'cby'=> session()->get('user_name'),
							     'solved'=> false,
							     'solvedAt'=> null,
							     'solvedBy'=> "",
							     'suspend'=> false,
							     'suspendAt'=> null,
							     'uat'=> date('Y-m-d\TH:i:s\Z'),
							     'uby'=> null
					        ]
					    )
				  ];

					$client = new Client();
					$ticketURL = env("END_POINT_API")."ticket";

					$ticket_response = $client->request('POST',$ticketURL , $headersBody);
					// dd($ticket_response->getBody());
					$ticket_data = $ticket_response->getBody()->getContents();
					$tickets =json_decode($ticket_data);
					//if api response success save data to tickets table, if api save fail roll back with error message

					$ticket_arr = [
						'ticket_id' => $uuid,
						'issue_id'=>$tickets->ticketIssueType->ticketIssueId,
						'issue_name'=>$tickets->ticketIssueType->name,
						'problem_id'=>$tickets->ticketProblem->ticketProblemId,
						'problem_name'=>$tickets->ticketProblem->name,
						'title'=>$tickets->title,
						'priority'=>(Int)$tickets->priority,
						'assign_tech_id'=>($tickets->assignUser)?$tickets->assignUser->appUserId:'',
						'assign_tech_name'=>($tickets->assignUser)?$tickets->assignUser->name:'',
						'assign_date'=>date('Y-m-d',strtotime($tickets->assignAt)),
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
			
				$ticket = Ticket::create($ticket_arr);
				DB::commit();
       		} catch (Exception $e) {
				   dd($e);
       			DB::rollback();
       			return redirect()->route('tickets.index')->with('success','Something wrong!');
       		}
       		
       }

			return redirect()->route('tickets.index'); 

	}

	public function edit($id)
	{
		$ticket = Ticket::findorfail($id);

		// $token = Session::get('access_token');

		// if($token === null){
		// 	return redirect('login');
		// }
		// $access_token = 'Bearer '.$token;
		// $uuid = (string) Str::uuid();

		// $headers =  [
		// 	    'headers' => [
		// 	        'Accept' => 'application/json',
	    //         	'Content-Type' => 'application/json',
		// 	        'Authorization'      => $access_token
		// 	    ]
		// 	  ];

  		// $client = new Client();
  		// $apiurl = env("END_POINT_API")."ticket".$myTicket->ticket_id."/".$uuid;
		// $res = $client->request('GET',$apiurl , $headers);
		// $response = $res->getBody()->getContents();
		// $ticket = json_decode($response);
		// dd($ticket);
		return view('tickets.edit',compact('ticket'));

	}

	public function update(Request $request,$id)
	{
		// dd($request->all());
		$loc_ticket = Ticket::where('ticket_id',$id)->get();
		if (count($loc_ticket)>0) {
			$myTicket = $loc_ticket->find($loc_ticket[0]->id);
		}
		// dd();
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
	       		DB::beginTransaction();
	       		//update ticket data to portal with api
	       		try {

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
								"ticketId"=>$myTicket->ticket_id,
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
								"cat" => $myTicket->created_at,
								"uat" => date('Y-m-d\TH:i:s\Z'),
								"cby" => "noc4",
								"uby" => null,
								"assignAt" => date('Y-m-d\TH:i:s\Z'),
								"adminSolved" => false,
								"adminSolvedAt" => null
					        ]
					    )
				  ];
				  
					$client = new Client();
					$ticketURL = env("END_POINT_API")."ticket/".$myTicket->ticket_id;

					$ticket_response = $client->request('PUT',$ticketURL , $headersBody);
					// dd($ticket_response->getBody());
					$ticket_data = $ticket_response->getBody()->getContents();
					$tickets =json_decode($ticket_data);
					//if api response success save data to tickets table, if api save fail roll back with error message

					$ticket_arr = [
						'ticket_id' => $myTicket->ticket_id,
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
			
				$ticketupdres = $myTicket->update($ticket_arr);
				DB::commit();
       		} catch (Exception $e) {
				   dd($e);
       			DB::rollback();
       			return redirect()->route('tickets.index')->with('success','Something wrong!');
       		}
       		
       }

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
		$data = [];

		if ($request->has('q')) {
			$search = $request->q;
			$searchdata = $this->searching($search,$temp_data);
			// dd($searchdata);
        	// this.setState({ data: searchdata });
        	$data = $searchdata;
		}else{
			$data = $temp_data;
		}

        return response()->json($data);

	}

	public function searching($word,$temp_data)
	{
		$collection = collect($temp_data);
		return $collection->filter(function($tech,$word) {
			  // dd($tech['name']);
			  $name = $tech['name'] != null ? $tech['name'] : "";
			  return (
			    $name == $word
			  );
			});
	}


	public function get_issue_type(Request $request)
	{
		$temp_data = TicketIssueService::getIssue();
		$data = [];

		if ($request->has('q')) {
			$search = $request->q;
			$searchdata = $this->search_issue_type($search,$temp_data);
			// dd($searchdata);
        	// this.setState({ data: searchdata });
        	$data = $searchdata;
		}else{
			$data = $temp_data;
		}

        return response()->json($data);
	}

	public function search_issue_type($word,$temp_data)
	{
		$collection = collect($temp_data);
		return $collection->filter(function($tech,$word) {
			  // dd($tech['name']);
			  $name = $tech['name'] != null ? $tech['name'] : "";
			  return (
			    $name == $word
			  );
			});
	}

	public function get_problem(Request $request)
	{
		$temp_data = TicketIssueProblemService::getProblems();
		$data = [];

		if ($request->has('q')) {
			$search = $request->q;
			$searchdata = $this->search_issue_problem($search,$temp_data);
			// dd($searchdata);
        	// this.setState({ data: searchdata });
        	$data = $searchdata;
		}else{
			$data = $temp_data;
		}

        return response()->json($data);
	}

	public function search_issue_problem($word,$temp_data)
	{
		$collection = collect($temp_data);
		return $collection->filter(function($tech,$word) {
			  // dd($tech['name']);
			  $name = $tech['name'] != null ? $tech['name'] : "";
			  return (
			    $name == $word
			  );
			});
	}

	public function get_site(Request $request)
	{
		$temp_data = SiteService::getSites();
		$data = [];

		if ($request->has('q')) {
			$search = $request->q;
			$searchdata = $this->search_site($search,$temp_data);
			// dd($searchdata);
        	// this.setState({ data: searchdata });
        	$data = $searchdata;
		}else{
			$data = $temp_data;
		}

        return response()->json($data);
	}

	public function search_site($word,$temp_data)
	{
		$collection = collect($temp_data);
		return $collection->filter(function($tech,$word) {
			  // dd($tech['name']);
			  $name = $tech['name'] != null ? $tech['name'] : "";
			  return (
			    $name == $word
			  );
			});
	}


}