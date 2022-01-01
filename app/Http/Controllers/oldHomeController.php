<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\plants;
use App\Models\Company;
use App\Models\employee;
use App\Models\DropDowns;
use App\Models\Departments;
use App\Models\devices;
use App\Models\calibration;
use App\Models\configurations;
use App\User;
use Carbon\Carbon;
use Gate;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
	public function __construct()
	{
	    $this->middleware('auth');
	}
	
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {       
        return view('home');
    }
}
