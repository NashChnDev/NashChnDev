<?php

namespace App\Http\Controllers;

use App\Models\employee;
use App\Models\country;
use App\Models\plants;
use App\Models\departments;
use App\Models\area;
use App\Models\DropDowns;
use App\Models\EmployeeBasic;



use App\Http\Controllers\Controller;
use App\Http\Requests\NewjoinerFormRequest;
use Exception;
use Auth;
use Gate;
use Yajra\Datatables\Datatables;
use App\Authorizable;
use App\Models\employee_primary;
use DB;
 

class NewjoinierController extends Controller
{
    use Authorizable;

    /**
     * Display a listing of the employees.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
		return view('newjoiner.index');
    }

	/**
     * Process ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getIndexData()
    {
        // if(Gate::allows('super_admin'))
        // {
        //     $employees = EmployeeBasic::with('department','country','state','city')->where('empcode', '!=','admin')->get();
        // }
        // else
        // {
        //     $employees = EmployeeBasic::with('department','country','state','city')->where('empcode', '!=','admin')->where('plant_id', Auth::user()->plantcode_id)->get();
        // }
    //     <a href="' . route('newjoiner.employee.show', [$row->id]) . '" class="btn btn-sm btn-outline-primary" title="Show employee">
    //     <i class="fas fa-fw fa-eye" aria-hidden="true"></i>
    // </a>
        //$employees = EmployeeBasic::whereRaw('empcode != "" AND empcode IS NOT NULL')->get();
        $employees = EmployeeBasic::whereRaw('empcode = "" OR empcode IS NULL')->get();
        //$employees = EmployeeBasic::where('empcode','=','')->orwhereNull('empcode')->get();
        //dd($employees);
        
		return Datatables::of($employees)
        ->addColumn('actions', function ($row) {
            
            return '<div class="btn-group btn-group-sm float-right" role="group">
                   
                    <a href="' . route('newjoiner.employee.edit', [$row->id]) . '" class="btn btn-sm btn-outline-primary" title="Edit employee">
                        <i class="fas fa-fw fa-edit" aria-hidden="true"></i>
                    </a>
                    <a href="' . (!empty($row->email_id)?route('joiningform.joiningform.personal', [$row->id,'newjoiner']):'javascript:void(0)') . '" class="btn btn-sm btn-outline-primary" data-type="newjoiner" data-email="'.$row->email_id.'" title="Personal Details">
                        <i class="fas fa-fw fa-address-card" aria-hidden="true"></i>
                    </a>
                    <a class="btn btn-sm btn-outline-primary mailcopylink" data-toggle="modal" title="Mail Copy" data-email="'.$row->email_id.'" id="'.$row->id.'">
                            <i class="fa fa-envelope" aria-hidden="true" style="color:#20a8d8"></i>
                    </a>
                    <button type="submit" class="btn btn-sm btn-outline-primary btn-delete" title="Delete employee" data-remote="' . route('newjoiner.employee.destroy', [$row->id]) . '" >
                        <i class="fas fa-fw fa-trash-alt" aria-hidden="true"></i>
                    </button>
                </div>'; 
        })
        ->rawColumns(['actions' => 'actions'])
        ->make(true);
    }

	
    /**
     * Show the form for creating a new employee.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
         $country = country::all();
      
        $plant = plants::where('status','Active')->get();
        $dropdowns = DropDowns::all();
        $departments = departments::where('deptstatus','Active')->get();
        $area = area::where('status','Active')->get();

        
        $mode = "create";
        
        return view('newjoiner.create', compact('departments','country','mode','plant','area','dropdowns'));
    }

    /**
     * Store a new employee in the storage.
     *
     * @param App\Http\Requests\EmployeesFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(NewjoinerFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
           // dd($data);
            
           EmployeeBasic::create($data);
           if(empty($data['empcode'])){
            return redirect()->route('newjoiner.employee.index')
            ->with('success_message', 'Employee was successfully added!');
           }else{
            return redirect()->route('employees.employee.index')
            ->with('success_message', 'Employee was successfully added!');
           }

         

        } catch (Exception $exception) {
            
            dd($exception);

            return back()->withInput()
                         ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }
    }

    public function personaldetail($id,$type)
    {
        // //dd($id);
        // $employee = EmployeeBasic::with('department')->findOrFail($id);
        // $data = array();
        // $data['name']=$employee['name'];
        // $data['email']=$employee['email_id'];
        // $data['Mobile_no']=$employee['mobile'];
        // // $data['employee_id']=$employee['empcode'];
        // $data['department']=$employee['deptname'];
        // // $object = employee_primary::updateOrCreate(
        // //                     ['employee_id' => $employee['empcode']],
        // //                     $data
        // //             );       
        // // if(!empty($object->id)){
            return redirect()->route('joiningform.joiningform.personal', $id);
        //}              
    }
    public function maillinkdetail($id)
    {
        //return $id;
        // $employee = EmployeeBasic::with('department')->findOrFail($id);
        // $data = array();
        // $data['name']=$employee['name'];
        // $data['email']=$employee['email_id'];
        // $data['Mobile_no']=$employee['mobile'];
        // // $data['employee_id']=$employee['empcode'];
        // $data['department']=$employee['department'];
        // $object = employee_primary::updateOrCreate(
        //                     ['employee_id' => $employee['empcode']],
        //                     $data
        //             );
        // if(!empty($object->id)){
            $simple_string = $id;
            $ciphering = "AES-128-CTR"; 
            $iv_length = openssl_cipher_iv_length($ciphering); 
            $options = 0; 
            $encryption_iv = '1234567891011121';
            $encryption_key = "";  
            $encryption = openssl_encrypt($simple_string, $ciphering,$encryption_key, $options, $encryption_iv);   
            $data = array("success"=>'success',"id"=> $encryption);
            echo json_encode($data,true);
        // }else{
        //     $data = array("success"=>'error');
        //     echo json_encode($data,true);
        // }       
    }

    /**
     * Display the specified employee.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $employee = EmployeeBasic::findOrFail($id);

        return view('newjoiner.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified employee.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
         $country = country::all();
         $employee = EmployeeBasic::findOrFail($id);
         $plant = plants::where('status','Active')->get();
         $dropdowns = DropDowns::all();
         $mode = "edit";
        //  if(Gate::allows('super_admin'))
        // {
        //     $departments = Departments::where('deptstatus','Active')->get();
        //      $mode = "";
        // }
        // else
        // {
        //     $departments = Departments::where('deptstatus','Active')->where('plant_id', Auth::user()->plantcode_id)->get(); 
        //     $mode = "edit";
        // }
        
        

        return view('newjoiner.edit', compact('employee','plant','dropdowns','mode'));
    }

    /**
     * Update the specified employee in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\EmployeesFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, NewjoinerFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $employee = EmployeeBasic::findOrFail($id);
            $employee->update($data);

            if(empty($data['empcode'])){
                return redirect()->route('newjoiner.employee.index')
                ->with('success_message', 'Employee was successfully added!');
               }else{
                return redirect()->route('employees.employee.index')
                ->with('success_message', 'Employee was successfully added!');
               }
            // return redirect()->route('newjoiner.employee.index')
            //                  ->with('success_message', 'Employee was successfully updated!');

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }        
    }

    /**
     * Remove the specified employee from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $employee = employee::findOrFail($id);
            if($employee->userTable->count()>0)
            {
                return response()->json(['status'=>false,'message' => 'Unable to delete Employee has '.$employee->userTable->count().' User']);
                
            }
            $employee->delete();

            return redirect()->route('employees.employee.index')
                             ->with('success_message', 'Employee was successfully deleted!');

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }
    }

    public function getdepartment($plant_id)
    {
        $department = departments::where('plant_id',$plant_id)->get();
        if($department!=null && count($department)>0)
            return response()->json(['status'=>'success','data'=>$department]);
        else
            return response()->json(['status'=>'error','msg'=>'Data Not Found']);
    }
    public function getarea($plant,$dept)
    {
        $area = area::where('plantcode',$plant)->where('departmentcode',$dept)->get();
        if($area!=null && count($area)>0)
        return response()->json(['status'=>'success','data'=>$area]);
          else
        return response()->json(['status'=>'error','msg'=>'Data Not Found']);
    }



}
