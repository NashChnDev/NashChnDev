<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\employee_file_details;
use App\Models\EmployeeBasic;
use App\Models\EmployeePersonal;
use App\Models\EmployeeEducation;
use App\Models\country;
use App\Models\state;
use App\Models\city;
use App\Models\plants;
use App\Models\Departments;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class EnrollController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($encryptdata)
    {        
        try{
            //$id= base64_decode($encryptdata);
            //dd($id);
            //$id = str_replace("nash","",$id);
            $simple_string = $encryptdata;
            $ciphering = "AES-128-CTR"; 
            $iv_length = openssl_cipher_iv_length($ciphering); 
            $options = 0; 
            $encryption_iv = '1234567891011121';
            $encryption_key = "";  
            $id = openssl_decrypt($simple_string, $ciphering,$encryption_key, $options, $encryption_iv);   
            //dd($id);
          
            $date = Carbon::today()->subDays(7);       
            $basic = EmployeeBasic::where('created_at', '>=', $date)->findOrFail($id);
            $country = country::all('id','country_name');
            $location = Plants::where('plantcode',$basic['joininglocation'])->select('location')->get(); 
            return view('enrollform.index',compact('basic','country','location'));
        }catch(ModelNotFoundException $err){
            dd($err);
            return view('enrollform.error');
        }    
        
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
