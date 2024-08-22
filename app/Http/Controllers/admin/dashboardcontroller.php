<?php

namespace App\Http\Controllers\admin;
use Auth;
use App\User;
use App\Products;
use App\Company;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class dashboardcontroller extends Controller
{
	public function index()
	{
		$usercount = User::all()->count();
		$prodcount = Products::all()->count();
		$companycount = Company::all()->count();

		return view("dashboard",compact('usercount',"prodcount","companycount"));
	}
}
