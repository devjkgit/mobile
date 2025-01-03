<?php

namespace App\Http\Controllers\admin;
use Auth;
use DB;
use App\Models\Repairing;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class dashboardcontroller extends Controller
{
	public function index(Request $request)
	{
		$start_date = $request->start_date;
		$end_date = $request->end_date;
		$data = Repairing::select(DB::raw('count(*) as count,sum(total) as total,sum(expense) as expense,sum(profit) as profit'));
		$data->where('userid',Auth::user()->id);		
		if($start_date && $end_date){
			$data->whereBetween(DB::raw('DATE(created_at)'), [$start_date, $end_date]);
		}
		$mobiledata = $data->first();
		$totalentries = $mobiledata->count;
		$totalrepairing = $mobiledata->total ?? 0;
		$totalexpense = $mobiledata->expense ?? 0;
		$totalprofit = $mobiledata->profit ?? 0;

		return view("dashboard",compact('totalentries',"totalrepairing","totalexpense","totalprofit","start_date","end_date"));
	}
}
