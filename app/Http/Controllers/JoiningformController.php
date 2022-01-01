<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// use App\Models\employee_primary;
// use App\Models\employee_secondary_details;
use App\Models\employee_file_details;
use App\Models\EmployeeBasic;
use App\Models\EmpPromotion;

use App\Models\EmployeePersonal;
use App\Models\EmployeeEducation;
use App\Models\country;
use App\Models\state;
use App\Models\city;
use App\Models\plants;
use App\Models\Departments;
use App\Models\area;
use App\Models\sub_area;
use App\User;
use Yajra\Datatables\Datatables;
use Exception;
use Auth;
use Gate;
use App\Authorizable;
use DB;
use App\Models\DropDowns;


class JoiningformController extends Controller
{
    use Authorizable;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {        
        $plants = Plants::where('status','Active')->get();
        // dd($plants);
        $drop_downs = DropDowns::get();
        return view('joiningform.index',compact('plants','drop_downs'));
    }
    public function nashemployee()
    {
        return view('joiningform.nashemployee');
    }
    public function getplantdetails($plantid)
    {
        //dd($plantid);
        $departments = departments::where('plant_id',$plantid)->select('deptcode','deptname')->get();
        //dd($departments);
        if(!empty($departments))
        {
            return response()->json(['Success'=>'Success','department'=> $departments]);
        } 
    }
    public function getareadetails($deptcode)
    {
        //dd($plantid);
        $area = area::where('departmentcode',$deptcode)->select('areacode','areaname')->get();
        //dd($departments);
        if(!empty($area))
        {
            return response()->json(['Success'=>'Success','area'=> $area]);
        } 
    }
    public function getsubareadetails($areacode)
    {
        $area = sub_area::where('areacode',$areacode)->select('subareacode','subareaname')->get();
        //dd($departments);
        if(!empty($area))
        {
            return response()->json(['Success'=>'Success','subarea'=> $area]);
        } 
    }
    

    public function getIndexData(Request $request)
    {
       
        $input = $request->all();
       
        if($input['exisiting'] == 'yes'){
            $joiningform = DB::table('employee_base_details')
                           ->whereNotNull('employee_id')
                           ->get();
        }else{
            $joiningform = DB::table('employee_base_details')
                           ->whereNull('employee_id')
                           ->get();
        }
        
        return Datatables::of($joiningform)
        ->addColumn('actions', function ($row) {
            
            return '<div class="btn-group btn-group-sm float-right" role="group">
            <a class="btn btn-sm btn-outline-primary checklistmodel" data-toggle="modal" id="'.$row->id.'">
            <i class="fa fa-address-card" aria-hidden="true" style="color:#20a8d8"></i>   
            </a>
            
                     <a href="' . route('joiningform.joiningform.personal', [$row->id]) . '" class="btn btn-sm btn-outline-primary" title="Show gaugerequestheader">
                        <i class="fas fa-fw fa-eye" aria-hidden="true"></i>
                    </a>                   
                    <a class="btn btn-sm btn-outline-primary mailcopylink" data-toggle="modal" title="Mail Copy" id="'.$row->id.'">
                            <i class="fa fa-envelope" aria-hidden="true" style="color:#20a8d8"></i>
                    </a>
                    <a class="btn btn-sm btn-outline-primary activateemployee" data-toggle="modal" title="Activate" id="'.$row->id.'">
                            <i class="fa fa-key" aria-hidden="true" style="color:#20a8d8"></i>
                    </a>                    
                    </div>'; 
        })
        ->addColumn('progressbar',function($row){
            return '  <div class="progress" style="margin:5px;">
            <div class="progress-bar bg-warning" role="progressbar" data-toggle="tooltip" data-placement="top" title="Personal Detail Completed" style="width: 20%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
            <div class="progress-bar bg-primary" role="progressbar" style="width: 20%" aria-valuenow="30" data-toggle="tooltip" data-placement="top" title="Education Detail Completed" aria-valuemin="0" aria-valuemax="100"></div>
            <div class="progress-bar" role="progressbar" style="width: 20%" aria-valuenow="20" data-toggle="tooltip" data-placement="top" title="Employment Detail Completed"aria-valuemin="0" aria-valuemax="100"></div>            
            
            <div class="progress-bar bg-success">60%</div>
            </div>';
        })
        ->rawColumns(['actions' => 'actions','progressbar' => 'progressbar'])
        ->make(true);
    }
                    // <button type="submit" class="btn btn-sm btn-outline-primary btn-delete" title="Delete gaugerequestheader" data-remote="' . route('gaugerequestheaders.gaugerequestheader.destroy', [$row->id]) . '" >
                    //     <i class="fas fa-fw fa-trash-alt" aria-hidden="true"></i>
                    // </button>
    public function personaldetail($id,$type)
    {       
        $basic = EmployeeBasic::findOrFail($id);
        $country = country::all('id','country_name');
        $location = Plants::where('plantcode',$basic['joininglocation'])->select('location')->get(); 
        $plants = Plants::where('status','Active')->get();
        $departments = departments::where('deptstatus','Active')->get();
        //dd($location[0]['location']);

        return view('joiningform.nashemployee',compact('basic','country','location','plants','departments','type'));
    }
    public function statelist($id)
    {
        $states = state::where('country_id',$id)->select('id','state_name')->get();
        if(!empty($states))
        {
            return response()->json(['Success'=>'Success','state'=> $states]);
        }        
    }
    public function dropdowns()
    {
        $dropdowns = DropDowns::whereIN('fieldsname',['Departments','bloodgroup','designation','Costcenter','functions','Costtitle','maritalstatus','bloodgroup','education','trade','grade'])->get();
        if(!empty($dropdowns))
        {
            return response()->json(['Success'=>'Success','dropdown'=> $dropdowns]);
        } 
    }
    public function citylist($id)
    {
        $citys = city::where('state_id',$id)->select('id','city_name')->get();
        if(!empty($citys))
        {
            return response()->json(['Success'=>'Success','city'=> $citys]);
        }
    }
    public function maillinkdetail($id)
    {   
        //dd($id);   
        $parameter=base64_encode($id);
        
        echo json_encode($parameter,true);        
    }
    
    public function checklistdetail($id)
    {
        $employee_joining = employee_secondary_details::where(['temp_empid' => $id,'type_of' => 'Checklist'])->get();         
        ///dd(count($employee_joining));
        if(count($employee_joining)>0){
            $employee_joining[0]['employee_details'] = json_decode($employee_joining[0]['employee_details'],true);
            return $employee_joining;
        }else{
            return $employee_joining;    
        }
        
    }
    public function addfiledetails(Request $request)
    {
        $input = $request->all();
        //dd($input['filename']);
        if($input['type'] == 'personalfiles'){
            if ($_FILES['file']['name']) {
                if (!$_FILES['file']['error']) {
                    $name = md5(rand(100, 200));
                    $ext = explode('.', $_FILES['file']['name']);
                    $filename = $name . '.' . $ext[1];
                    $destination = public_path() . '/storage/HrFiles/' . $filename;
                    $location = $_FILES["file"]["tmp_name"];
                    move_uploaded_file($location, $destination); 
                    $files =array();
                    $files['temp_empid'] = $input['tempid'];
                    $files['file_name'] = $input['filename'];
                    $files['file_path'] = $filename;
                    $secondary_info = employee_file_details::updateOrCreate(
                        ['temp_empid' => $input['tempid'],'file_name' => $input['filename']],
                        $files
                    );               
                    return response()->json(['Success'=>'Success']);
                } else {
                    //echo = 'Ooops!  Your upload triggered the following error:  '.$_FILES['file']['error'];
                }
            }
        }
        if($input['type'] == 'profile_file'){
            if ($_FILES['file']['name']) {
                if (!$_FILES['file']['error']) {
                    $name = md5(rand(100, 200));
                    $ext = explode('.', $_FILES['file']['name']);
                    $filename = $name . '.' . $ext[1];
                    $destination = public_path() . '/storage/profile/' . $filename;
                    $location = $_FILES["file"]["tmp_name"];
                    move_uploaded_file($location, $destination); 
                    $files =array();                  
                    $files[''] = $filename;
                    DB::table('employee_primary')->where('id', $input['tempid'])->update(['profile_img' => $filename]);             
                    return response()->json(['Success'=>'Success']);
                } else {
                    //echo = 'Ooops!  Your upload triggered the following error:  '.$_FILES['file']['error'];
                }
            }
        }

    }
    public function saveprofiledet(Request $request)
    {
        $input = $request->all();
        if ($_FILES['file']['name']) {
            if (!$_FILES['file']['error']) {
                $name = md5(rand(100, 200));
                $ext = explode('.', $_FILES['file']['name']);
                $filename = $name . '.' . $ext[1];
                $destination = public_path() . '/storage/profile/' . $filename;
                $location = $_FILES["file"]["tmp_name"];
                move_uploaded_file($location, $destination); 
                $files =array();                  
                $files[''] = $filename;
                DB::table('employee_personal')->where('temp_empid', $input['tempid'])->update(['profile_img' => $filename]);             
                return response()->json(['Success'=>'Success']);
            } else {
                //echo = 'Ooops!  Your upload triggered the following error:  '.$_FILES['file']['error'];
            }
        }
        //dd($input);
    }

    public function savefiledetails(Request $request)
    {
        $input = $request->all();        

            if ($_FILES['file']['name']) {
                if (!$_FILES['file']['error']) {
                    $name = md5(rand(100, 200));
                    $ext = explode('.', $_FILES['file']['name']);
                    $filename = $name . '.' . $ext[1];
                    $destination = public_path() . '/storage/HrFiles/' . $filename;
                    $location = $_FILES["file"]["tmp_name"];
                    if(move_uploaded_file($location, $destination)){                                                               
                        if($input['file_base_path']=='personal'){
                            if($input['filename']=='Pan Card'){
                                DB::table('employee_personal')->where('temp_empid', $input['temp_empid'])->update(['pancard_no' => $input['file_description'],'pancard_file' => $filename]);             
                            }
                            else if($input['filename']=='Aadhar Card'){
                                DB::table('employee_personal')->where('temp_empid', $input['temp_empid'])->update(['aadhar_card_no' => $input['file_description'],'aadhar_card_file' => $filename]);             
                            }else{
                
                            } 
                        }
                        $files =array();
                        $files['temp_empid'] = $input['temp_empid'];
                        $files['file_description'] = $input['file_description'];
                        $files['file_base_path']= $input['file_base_path'];
                        $files['file_name'] =  $input['filename'];
                        $files['file_path'] = $filename;
                        $files['removebtn'] = $input['removebtn'];
                        $files['basename'] = $input['basename'];
                        $files['view_status'] = 0;
                        // employee_file_details::updateOrCreate(
                        //     ['temp_empid' => $input['temp_empid'],'file_name' => $input['filename'],'file_base_path' => $input['file_base_path']],
                        //     $files
                        // );  
                        employee_file_details::create($files);
                    }        
                } else {
                    $echoval = 'Ooops!  Your upload triggered the following error:  '.$_FILES['file']['error'];
                    return response()->json(['Success'=>$echoval]);
                }
                return response()->json(['Success'=>'Success','filepath'=>$filename]);
            }           
    }
    
    public function savepersonaldetails(Request $request)
    {
        $input = $request->all(); 
        $id = EmployeePersonal::updateOrCreate(['temp_empid' => $input['temp_empid']],$input)->id;        
        if($id){
            return response()->json(['Success'=>'Success','idvalue'=> $id]);
        }
    }

    public function savemanage(Request $request)
    {
        $input = $request->all(); 
        //dd($input);
        if(empty($input['id'])){
            $id = EmpPromotion::Create($input)->id;        
        }else{
            $id = EmpPromotion::where('id', $input['id'])->Update($input);        
        }
        
        if($id){
            return response()->json(['Success'=>'Success','idvalue'=> $id]);
        }
        
    }
    public function educationsave(Request $request)
    {
        $input = $request->all(); 
        $id = EmployeeEducation::updateOrCreate(['temp_empid' => $input['temp_empid']],$input)->id;        
        if($id){
            return response()->json(['Success'=>'Success','idvalue'=> $id]);
        }
    }
    
    public function getpersonaldetails($id){
        
        $personaldetails = EmployeePersonal::where('temp_empid',$id)->get();  
        if($personaldetails){
            return response()->json(['Success'=>'Success','details'=> $personaldetails]);
        }
    }
    public function getpromotionsdetails($id){
        
        $promotiondetails = EmpPromotion::where('temp_empid',$id)->get();  
        if($promotiondetails){
            return response()->json(['status'=>'Success','details'=> $promotiondetails]);
        }
    }
    
    public function geteducationdetails($id)
    {
        $educationdetails = EmployeeEducation::where('temp_empid',$id)->get();  
        if($educationdetails){
            return response()->json(['Success'=>'Success','details'=> $educationdetails]);
        }
    }
    public function getfiledetails($id,$basepath){
        $personalfiledetails = employee_file_details::where([['temp_empid',$id],['file_base_path',$basepath],['view_status','0']])->get();  
        if($personalfiledetails){
            return response()->json(['Success'=>'Success','details'=> $personalfiledetails]);
        }
    }
    public function getemployeefiles($id){
        $employeefiles = employee_file_details::where([['temp_empid',$id],['view_status','0'],['employee_verified_status','1']])->select('id','file_base_path','file_name','file_description','file_path','hr_verified_status')->get();  
        if($employeefiles){
            return response()->json(['Success'=>'Success','details'=> $employeefiles]);
        }
    }
    public function deletefiles($fileid,$tempid){
        $personalfiledetails = employee_file_details::where([['temp_empid',$tempid],['id',$fileid]])->update(['view_status'=>'1']);  
        return response()->json(['Success'=>'Success']);
        
    }
    public function employeeverfied($fileid,$tempid){
        $personalfiledetails = employee_file_details::where([['temp_empid',$tempid],['id',$fileid]])->update(['employee_verified_status'=>'1']);  
        return response()->json(['Success'=>'Success']);
        
    }
    public function hrverfied($fileid,$tempid){
        $personalfiledetails = employee_file_details::where([['temp_empid',$tempid],['id',$fileid]])->update(['hr_verified_status'=>'1']);  
        return response()->json(['Success'=>'Success']);
    }
    

    public function addPersonaldetail(Request $request)
    {
        $input = $request->all();
       
        $primary_info = false;
        if($input['type_of'] == 'Family'){
            $primary_info = employee_primary::where('id',$input['tempid'])->update($input['primary']);  
            if($input['secondary'] != ''){
                $input['secondary']['employee_details'] = json_encode($input['secondary']['employee_details']);        
                $secondary_info = employee_secondary_details::updateOrCreate(
                    ['temp_empid' => $input['tempid'],'type_of' => $input['type_of']],
                    $input['secondary']
                );
            }
        }

        if($input['type_of'] == 'Education'){           
            if($input['secondary'] != ''){
                $input['secondary']['employee_details'] = json_encode($input['secondary']['employee_details']);        
                $secondary_info = employee_secondary_details::updateOrCreate(
                    ['temp_empid' => $input['tempid'],'type_of' => $input['type_of']],
                    $input['secondary']
                );
                $primary_info = true;
            }
        }
        if($input['type_of'] == 'Checklist'){           
            if($input['secondary'] != ''){
                $input['secondary']['employee_details'] = json_encode($input['secondary']['employee_details']);        
                $secondary_info = employee_secondary_details::updateOrCreate(
                    ['temp_empid' => $input['tempid'],'type_of' => $input['type_of']],
                    $input['secondary']
                );
                $primary_info = true;
            }
        }       
        
        if($input['type_of'] == 'employment'){           
            $primary_info = employee_primary::where('id',$input['tempid'])->update($input['primary']);  
            if($input['secondary'] != ''){
                $input['secondary']['employee_details'] = json_encode($input['secondary']['employee_details']);        
                $secondary_info = employee_secondary_details::updateOrCreate(
                    ['temp_empid' => $input['tempid'],'type_of' => $input['type_of']],
                    $input['secondary']
                );
                $primary_info = true;
            }
        }
        if($input['type_of'] == 'others'){           
            $primary_info = employee_primary::where('id',$input['tempid'])->update($input['primary']);              
        }
        
        
        
        
        
        if($primary_info == true){
            return response()->json(['Success'=>'Success']);
        }else{
            return response()->json(['error'=>'false']);
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
        $input = $request->all();
        $id = DB::table('employee_base_details')->insertGetId($input);        
        if($id){
            return response()->json(['Success'=>'Success','idvalue'=> $id]);
        }
    }
    public function uploademployee(Request $request)
    {
        $input = $request->all();
        $id = DB::table('employee_base_details')->insertGetId($input);        
        if($id){
            return response()->json(['Success'=>'Success','idvalue'=> $id]);
        }

    }


    public function updateempcode(Request $request)
    {
        $input = $request->all();        
        $id = employee_primary::where('id',$input['primaryid'])->update(['employee_id' => $input['employee_id']]);              
        if($id){
            return response()->json(['Success'=>'Success']);
        }

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
