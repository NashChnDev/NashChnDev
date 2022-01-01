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
use DB;

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
       $employee = DB::select("SELECT Department, YEAR(`DOJ`) AS DOJ,Gender,EmployementType FROM `employeelist` WHERE YEAR(`DOJ`) > 2015 AND `EmployeesStatus` = 'Working' AND Department != 'NOT Assigned'");
       $employeecount = count($employee);
       $pielist= array_count_values(array_column($employee, 'Department'));
       $activelist = array_count_values(array_column($employee,'DOJ'));
       $genderlist = array_count_values(array_column($employee,'Gender'));
       $employeetype= array_count_values(array_column($employee,'EmployementType'));
       //dd($employeetype);

        return view('home',compact('pielist','activelist','genderlist','employeetype'));
    }
}
