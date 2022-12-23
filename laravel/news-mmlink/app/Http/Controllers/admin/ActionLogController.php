<?php

namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ActionLog;
use Carbon\Carbon;

class ActionLogController extends Controller
{
    public function action_lists(Request $request)
    {
        $today = Carbon::now()->toDateTimeString();
        $start = $request->start ? date('Y-m-d',strtotime($request->start)) : date('Y-m-d',strtotime($today));
        $end = $request->end ? date('Y-m-d',strtotime($request->end)) : date('Y-m-d',strtotime($today));

        $action_logs = new ActionLog();

        if ($request->start != null && $request->end != null) {
            $action_logs = $action_logs->whereDate('login_date','>=',$start)->whereDate('login_date','<=',$end);
        }
        // dd($action_logs->get());
        $action_logs = $action_logs->orderBy('created_at','desc')->get();
        return view('actionLogs.list',compact('action_logs','start','end'));
    }
}
