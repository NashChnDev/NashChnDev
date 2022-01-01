<?php

namespace App\Http\Controllers;

use App\Models\Vendors;
use App\Models\devices;
use App\Models\Company;
use App\Models\Customer;
use App\Models\DropDowns;
use App\DeviceImport;
use App\deviceErrorExport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\DevicesFormRequest;
use Exception;
use Validator;
use App\Models\Plants;
use Auth;
use Gate;
use Excel;
use Yajra\Datatables\Datatables;
use Maatwebsite\Excel\HeadingRowImport;
use Illuminate\Support\Collection;
use App\Authorizable;


class DevicesController extends Controller
{
    use Authorizable;

    /**
     * Display a listing of the devices.
     *
     * @return Illuminate\View\View
     */
    
    public function index()
    {
		return view('devices.index');
    }

	/**
     * Process ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getIndexData()
    {
        if(Gate::allows('super_admin'))
        {
		  $devicesObjects = devices::with('vendor','customer','optionvalue','company')->get();
        }
        else
        {
          $Auth_plants = explode(',',Auth::user()->plantcode_id);
          $devicesObjects = devices::with('vendor','customer','optionvalue','company')->whereIn('plant_id', $Auth_plants)->get();  
        }
        
		return Datatables::of($devicesObjects)
        ->addColumn('actions', function ($row) {
            
            return '<div class="btn-group btn-group-sm float-right" role="group">
                    <a href="' . route('devices.devices.show', [$row->id]) . '" class="btn btn-sm btn-outline-primary" title="Show devices">
                        <i class="fas fa-fw fa-eye" aria-hidden="true"></i>
                    </a>
                    <a href="' . route('devices.devices.edit', [$row->id]) . '" class="btn btn-sm btn-outline-primary" title="Edit devices">
                        <i class="fas fa-fw fa-edit" aria-hidden="true"></i>
                    </a>
                    <button type="submit" class="btn btn-sm btn-outline-primary btn-delete" title="Delete devices" data-remote="' . route('devices.devices.destroy', [$row->id]) . '" >
                        <i class="fas fa-fw fa-trash-alt" aria-hidden="true"></i>
                    </button>
                </div>'; 
        })
        ->rawColumns(['actions' => 'actions'])
        ->make(true);
    }

	
    /**
     * Show the form for creating a new devices.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        
        $Auth_plants = explode(',',Auth::user()->plantcode_id);
        
        if(Gate::allows('super_admin'))
        {
          $plants = Plants::where('status','Active')->get();
          $vendors = Vendors::where('vendorstatus','Active')->pluck('vendorcode','id');
          $customers = Customer::where('customerstatus','Active')->pluck('customercode','id');
        }
        else
        {
          
          $plants = Plants::where('status','Active')->whereIn('plantcode', $Auth_plants)->get();
          $vendors = Vendors::where('vendorstatus','Active')->whereIn('plant_id', $Auth_plants)->pluck('vendorcode','id');
          $customers = Customer::where('customerstatus','Active')->whereIn('plant_id',$Auth_plants)->pluck('customercode','id');
        }
        
        
        $optionvalues = DropDowns::where('fieldsname',config('constants.options_from_db')['Gauge_Statuses'])->Where(function ($query) use($Auth_plants) {
             for ($i = 0; $i < count($Auth_plants); $i++){
                $query->orwhere('plant_id', 'like',  '%' . $Auth_plants[$i] .'%');
             }      
        })->pluck('optionvalue','id');
        
        $optionvaluesDevDescriptions = DropDowns::where('fieldsname',config('constants.options_from_db')['devices_description'])->Where(function ($query) use($Auth_plants) {
             for ($i = 0; $i < count($Auth_plants); $i++){
                $query->orwhere('plant_id', 'like',  '%' . $Auth_plants[$i] .'%');
             }      
        })->pluck('optionvalue','id');
        
        $optionvaluesDevType = DropDowns::where('fieldsname',config('constants.options_from_db')['Devices_Type'])->Where(function ($query) use($Auth_plants) {
             for ($i = 0; $i < count($Auth_plants); $i++){
                $query->orwhere('plant_id', 'like',  '%' . $Auth_plants[$i] .'%');
             }      
        })->pluck('optionvalue','id');
        
        
        $optionvaluesCategory        = DropDowns::where('fieldsname',config('constants.options_from_db')['Devices_Catagory'])->Where(function ($query) use($Auth_plants) {
             for ($i = 0; $i < count($Auth_plants); $i++){
                $query->orwhere('plant_id', 'like',  '%' . $Auth_plants[$i] .'%');
             }      
        })->pluck('optionvalue','id');
        
        $optionvaluesMechanism       = DropDowns::where('fieldsname',config('constants.options_from_db')['Devices_Mechanism'])->Where(function ($query) use($Auth_plants) {
             for ($i = 0; $i < count($Auth_plants); $i++){
                $query->orwhere('plant_id', 'like',  '%' . $Auth_plants[$i] .'%');
             }      
        })->pluck('optionvalue','id');
        
        $optionvaluesUnits           = DropDowns::where('fieldsname',config('constants.options_from_db')['UOM'])->Where(function ($query) use($Auth_plants) {
             for ($i = 0; $i < count($Auth_plants); $i++){
                $query->orwhere('plant_id', 'like',  '%' . $Auth_plants[$i] .'%');
             }      
        })->pluck('optionvalue','id');
        
        $optionvaluesUsage_Location  = DropDowns::where('fieldsname',config('constants.options_from_db')['Usage_Location'])->Where(function ($query) use($Auth_plants) {
             for ($i = 0; $i < count($Auth_plants); $i++){
                $query->orwhere('plant_id', 'like',  '%' . $Auth_plants[$i] .'%');
             }      
        })->pluck('optionvalue','id');
        
        $optionvaluesProperty        = DropDowns::where('fieldsname',config('constants.options_from_db')['Devices_Property'])->Where(function ($query) use($Auth_plants) {
             for ($i = 0; $i < count($Auth_plants); $i++){
                $query->orwhere('plant_id', 'like',  '%' . $Auth_plants[$i] .'%');
             }      
        })->pluck('optionvalue','id');
        
        $companies = Company::where('company_status','Active')->get();
        
        return view('devices.create', compact('plants','vendors','customers','optionvalues','companies','optionvaluesDevDescriptions','optionvaluesDevType','optionvaluesCategory','optionvaluesMechanism','optionvaluesUnits','optionvaluesUsage_Location','optionvaluesProperty'));
    }

    /**
     * Store a new devices in the storage.
     *
     * @param App\Http\Requests\DevicesFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(DevicesFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            //dd($data);
            devices::create($data);

            return redirect()->route('devices.devices.index')
                             ->with('success_message', 'Devices was successfully added!');

        } catch (Exception $exception) {
            
            dd($exception);

            return back()->withInput()
                         ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }
    }

    /**
     * Display the specified devices.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $devices = devices::with('vendor','customer','optionvalue','company')->findOrFail($id);

        return view('devices.show', compact('devices'));
    }

    /**
     * Show the form for editing the specified devices.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
		$Auth_plants = explode(',',Auth::user()->plantcode_id);
		
        if(Gate::allows('super_admin'))
        {
          $plants = Plants::where('status','Active')->get();
          $vendors = Vendors::where('vendorstatus','Active')->pluck('vendorcode','id');
          $customers = Customer::where('customerstatus','Active')->pluck('customercode','id');
          $devices = devices::with('vendor','customer','optionvalue','company')->findOrFail($id);
                        
        }
        else
        {
          $Auth_plants = explode(',',Auth::user()->plantcode_id);
          $plants = Plants::where('status','Active')->whereIn('plantcode', $Auth_plants)->get();
          $vendors = Vendors::where('vendorstatus','Active')->whereIn('plant_id', $Auth_plants)->pluck('vendorcode','id');
          $customers = Customer::where('customerstatus','Active')->whereIn('plant_id',$Auth_plants)->pluck('customercode','id');
          $devices = devices::with('vendor','customer','optionvalue','company')->findOrFail($id);
            
            if($devices->status != "Approach_Calibration" && $devices->status != "idle")
            {
               return back()->withInput()
                         ->withErrors(['unexpected_error' => 'This Device is Running stage!']); 
            }
        }
        
        
      //  dd($devices);
        $optionvalues = DropDowns::pluck('optionvalue','id')->all();
        $companies = Company::where('company_status','Active')->get();
        
        
        /*$optionvaluesDevDescriptions = DropDowns::where('fieldsname',config('constants.options_from_db')['devices_description'])->pluck('optionvalue','id');
        $optionvaluesDevType = DropDowns::where('fieldsname',config('constants.options_from_db')['Devices_Type'])->pluck('optionvalue','id');
        
        
        $optionvaluesCategory        = DropDowns::where('fieldsname',config('constants.options_from_db')['Devices_Catagory'])->pluck('optionvalue','id');
        $optionvaluesMechanism       = DropDowns::where('fieldsname',config('constants.options_from_db')['Devices_Mechanism'])->pluck('optionvalue','id');
        $optionvaluesUnits           = DropDowns::where('fieldsname',config('constants.options_from_db')['UOM'])->pluck('optionvalue','id');
        $optionvaluesUsage_Location  = DropDowns::where('fieldsname',config('constants.options_from_db')['Usage_Location'])->pluck('optionvalue','id');
        $optionvaluesProperty        = DropDowns::where('fieldsname',config('constants.options_from_db')['Devices_Property'])->pluck('optionvalue','id');*/
        
        $optionvalues = DropDowns::where('fieldsname',config('constants.options_from_db')['Gauge_Statuses'])->Where(function ($query) use($Auth_plants) {
             for ($i = 0; $i < count($Auth_plants); $i++){
                $query->orwhere('plant_id', 'like',  '%' . $Auth_plants[$i] .'%');
             }      
        })->pluck('optionvalue','id');
        
        $optionvaluesDevDescriptions = DropDowns::where('fieldsname',config('constants.options_from_db')['devices_description'])->Where(function ($query) use($Auth_plants) {
             for ($i = 0; $i < count($Auth_plants); $i++){
                $query->orwhere('plant_id', 'like',  '%' . $Auth_plants[$i] .'%');
             }      
        })->pluck('optionvalue','id');
        
        $optionvaluesDevType = DropDowns::where('fieldsname',config('constants.options_from_db')['Devices_Type'])->Where(function ($query) use($Auth_plants) {
             for ($i = 0; $i < count($Auth_plants); $i++){
                $query->orwhere('plant_id', 'like',  '%' . $Auth_plants[$i] .'%');
             }      
        })->pluck('optionvalue','id');
        
        
        $optionvaluesCategory = DropDowns::where('fieldsname',config('constants.options_from_db')['Devices_Catagory'])->Where(function ($query)                 use($Auth_plants) {
                        for ($i = 0; $i < count($Auth_plants); $i++){
                        $query->orwhere('plant_id', 'like',  '%' . $Auth_plants[$i] .'%');
                        }      
                        })->pluck('optionvalue','id');
        
        $optionvaluesMechanism       = DropDowns::where('fieldsname',config('constants.options_from_db')['Devices_Mechanism'])->Where(function ($query) use($Auth_plants) {
             for ($i = 0; $i < count($Auth_plants); $i++){
                $query->orwhere('plant_id', 'like',  '%' . $Auth_plants[$i] .'%');
             }      
        })->pluck('optionvalue','id');
        
        $optionvaluesUnits           = DropDowns::where('fieldsname',config('constants.options_from_db')['UOM'])->Where(function ($query) use($Auth_plants) {
             for ($i = 0; $i < count($Auth_plants); $i++){
                $query->orwhere('plant_id', 'like',  '%' . $Auth_plants[$i] .'%');
             }      
        })->pluck('optionvalue','id');
        
        $optionvaluesUsage_Location  = DropDowns::where('fieldsname',config('constants.options_from_db')['Usage_Location'])->Where(function ($query) use($Auth_plants) {
             for ($i = 0; $i < count($Auth_plants); $i++){
                $query->orwhere('plant_id', 'like',  '%' . $Auth_plants[$i] .'%');
             }      
        })->pluck('optionvalue','id');
        
        $optionvaluesProperty        = DropDowns::where('fieldsname',config('constants.options_from_db')['Devices_Property'])->Where(function ($query) use($Auth_plants) {
             for ($i = 0; $i < count($Auth_plants); $i++){
                $query->orwhere('plant_id', 'like',  '%' . $Auth_plants[$i] .'%');
             }      
        })->pluck('optionvalue','id');

        return view('devices.edit', compact('plants','devices','vendors','customers','optionvalues','companies','optionvaluesDevDescriptions','optionvaluesDevType','optionvaluesCategory','optionvaluesMechanism','optionvaluesUnits','optionvaluesUsage_Location','optionvaluesProperty'));
    }
    

    /**
     * Update the specified devices in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\DevicesFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, DevicesFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $devices = devices::findOrFail($id);
            
            if($devices->status == 'inuse')
            {
                return back()->withInput()
                         ->withErrors(['unexpected_error' => 'Does not update. This Devices already using!']); 
            }

            $devices->update($data);
            
          

            return redirect()->route('devices.devices.index')
                             ->with('success_message', 'Devices was successfully updated!');

        } catch (Exception $exception) {
            
             dd($exception);

            return back()->withInput()
                         ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }        
    }

    /**
     * Remove the specified devices from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            
            $devices = devices::findOrFail($id);
            
            if($devices->status == 'inuse')
            {
                return response()->json(['status'=>'error','msg' => 'Does not delete. This Devices already using!']); 
            }
            
          
            if($devices->deviceINreq->count()>0)
            {
                return response()->json(['status'=>'error','msg' => 'Unable to delete Device has '.$devices->deviceINreq->count().' Device Request Process']);
                
            }
            
            if($devices->deviceINissue->count()>0)
            {
                return response()->json(['status'=>'error','msg' => 'Unable to delete Device has '.$devices->deviceINissue->count().' Device Issue Process']);
                
            }
            
            if($devices->deviceINcalibrate->count()>0)
            {
                return response()->json(['status'=>'error','msg' => 'Unable to delete Device has '.$devices->deviceINcalibrate->count().' Device Calibrate Process']);
                
            }
            
            if($devices->deviceINscrapReq->count()>0)
            {
                return response()->json(['status'=>'error','msg' => 'Unable to delete Device has '.$devices->deviceINscrapReq->count().' Device Scrap Process']);
                
            }
            
            $devices->delete();

            return redirect()->route('devices.devices.index')
                             ->with('success_message', 'Devices was successfully deleted!');

        } catch (Exception $exception) {
            dd($exception);

            return back()->withInput()
                         ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }
    }
    
    
       public function import()
    {
        return view('devices.import');
    }
    
    
        public function uploadDevice(Request $request)
    {
         $v = Validator::make($request->all(), [
        'import_file' => 'required|file|max:1024',
    ]);

    if ($v->fails())
    {
        return redirect()->back()->withErrors($v->errors());
    }
        
       else
           
        {
           $headings = (new HeadingRowImport)->toArray(request()->file('import_file'))[0][0];
           $headings[]="Remarks";
            $old_import = new DeviceImport($headings);
//           dd($headings);
           $errors=[];
        $importFile = Excel::import($old_import,request()->file('import_file'));
        $errorflag=0;
        $errorrow=array();
        $failures=$old_import->failures();
        foreach ($failures as $failure) {
            $errors[]=["row"=>$failure->row(),'message'=>implode(',',$failure->errors()),'values'=>$failure->values()];
                        }
           if($failures->count()>0)
           {
             $errors=collect($errors)->groupBy('row')->toArray();
               foreach($errors as $error)
                 $messages=[];
                 foreach($error as $cell)
                     $messages[]=$cell['message'];
                $msg=implode(',',$messages);
                 $errorrow[]=array_merge($error[0]['values'],['Remarks'=>$msg]);
               
               $errorExport=array_merge([$headings],$errorrow);
              
               $export = new deviceErrorExport($errorExport);
               
               return Excel::download($export, 'importError.xlsx');
             }
           
           else
           {
               return redirect()->back()->with('success_message',"Imported Successfully");
           }
                 
    }
        }



}
