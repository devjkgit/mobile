<?php

namespace App\Http\Controllers\admin;
use Auth;
use DB;
use App\Repairing;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class dashboardcontroller extends Controller
{
	public function index(Request $request)
	{
		$start_date = $request->start_date;
		$end_date = $request->end_date;
		$data = Repairing::select(DB::raw('count(*) as count,sum(total) as total,sum(expense) as expense,sum(profit) as profit'));
		if($start_date && $end_date){
			$data->whereBetween(DB::raw('DATE(created_at)'), [$start_date, $end_date]);
		}
		$mobiledata = $data->first();
		$totalentries = $mobiledata->count;
		$totalrepairing = $mobiledata->total;
		$totalexpense = $mobiledata->expense;
		$totalprofit = $mobiledata->profit;

		return view("dashboard",compact('totalentries',"totalrepairing","totalexpense","totalprofit","start_date","end_date"));
	}
}
