<?php

namespace App\Http\Controllers;

use App\Models\DropDowns;
use App\Models\plants;
use App\Http\Controllers\Controller;
use App\Http\Requests\DropDownsFormRequest;
use Exception;
use Auth;
use Gate;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;
use App\Authorizable;


class DropDownsController extends Controller
{
    use Authorizable;

    /**
     * Display a listing of the drop downs.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        if(Gate::allows('super_admin'))
        {
        $plants = Plants::where('status','Active')->get();
        }
        else
        {
          $plants = Plants::where('status','Active')->where('plantcode', Auth::user()->plantcode_id)->get();  
        }
		return view('drop_downs.index',compact('plants'));
    }

	/**
     * Process ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getIndexData(Request $req)
    {
        $option_name=$req->get('option_name');
        
        /*if(Gate::allows('super_admin'))
        {
        $dropDownsObjects = DropDowns::where('fieldsname','LIKE','%'.$option_name.'%')->get();
        }
        else
        {
        $dropDownsObjects = DropDowns::where('fieldsname','LIKE','%'.$option_name.'%')->where('plant_id', Auth::user()->plantcode_id)->get();
        }*/
        
        $dropDownsObjects = DropDowns::where('fieldsname','LIKE','%'.$option_name.'%');
        
		return Datatables::of($dropDownsObjects)
        ->addColumn('actions', function ($row) {
            
            return '<div class="btn-group btn-group-sm float-right" role="group">
                    <a href="' . route('drop_downs.drop_downs.show', [$row->id]) . '" class="btn btn-sm btn-outline-warning" title="Show DropDowns">
                        <i class="fas fa-fw fa-eye" aria-hidden="true"></i>
                    </a>
                    <a href="' . route('drop_downs.drop_downs.edit', [$row->id]) . '" class="btn btn-sm btn-outline-primary" title="Edit DropDowns">
                        <i class="fas fa-fw fa-edit" aria-hidden="true"></i>
                    </a>
                    <button type="submit" class="btn btn-sm btn-outline-danger btn-delete" title="Delete DropDowns" data-remote="' . route('drop_downs.drop_downs.destroy', [$row->id]) . '" >
                        <i class="fas fa-fw fa-trash-alt" aria-hidden="true"></i>
                    </button>
                </div>'; 
        })
        ->rawColumns(['actions' => 'actions'])
        ->make(true);
    }

	
    /**
     * Show the form for creating a new drop downs.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        if(Gate::allows('super_admin'))
        {
        $plants = Plants::where('status','Active')->get();
        }
        else
        {
          $plants = Plants::where('status','Active')->where('plantcode', Auth::user()->plantcode_id)->get();  
        }
        
        return view('drop_downs.create',compact('plants'));
    }

    /**
     * Store a new drop downs in the storage.
     *
     * @param App\Http\Requests\DropDownsFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(DropDownsFormRequest $request)
    {
         // dd($request); 
         $input = $request->all();
         //dd($input);
        
        $plantcode_id = implode(',',$request->plant_id);
        
        try {
            
            $data = $request->getData();
            
            $data['plant_id'] = $plantcode_id;

            DropDowns::create($data);

            return redirect()->route('drop_downs.drop_downs.index')
                             ->with('success_message', 'Drop Downs was successfully added!');

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }
    }

    /**
     * Display the specified drop downs.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $dropDowns = DropDowns::findOrFail($id);

        return view('drop_downs.show', compact('dropDowns'));
    }

    /**
     * Show the form for editing the specified drop downs.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $dropDowns = DropDowns::findOrFail($id);
        
        
        if(Gate::allows('super_admin'))
        {
        $plants = Plants::where('status','Active')->get();
        }
        else
        {
          $plants = Plants::where('status','Active')->where('plantcode', Auth::user()->plantcode_id)->get();  
        
        
        
        
            if($dropDowns->devices_catagory->count()>0)
            {
                return back()->withInput()
                         ->withErrors(['unexpected_error' => 'Unable to edit DropDowns has '.$dropDowns->devices_catagory->count().' Device Master']);
                
            }
        
           if($dropDowns->devices_description->count()>0)
            {
                return back()->withInput()
                         ->withErrors(['unexpected_error' => 'Unable to edit DropDowns has '.$dropDowns->devices_description->count().' Device Master']);
                
            }
        
            if($dropDowns->devices_type->count()>0)
            {
               return back()->withInput()
                         ->withErrors(['unexpected_error' => 'Unable to edit DropDowns has '.$dropDowns->devices_type->count().' Device Master']);
                
            }
            
            if($dropDowns->devices_property->count()>0)
            {
               return back()->withInput()
                         ->withErrors(['unexpected_error' => 'Unable to edit DropDowns has '.$dropDowns->devices_property->count().' Device Master']);
                
            }
        
           if($dropDowns->devices_mechanism->count()>0)
            {
               return back()->withInput()
                         ->withErrors(['unexpected_error' => 'Unable to edit DropDowns has '.$dropDowns->devices_mechanism->count().' Device Master']);
                
            }
        
            if($dropDowns->usage_location->count()>0)
            {
               return back()->withInput()
                         ->withErrors(['unexpected_error' => 'Unable to edit DropDowns has '.$dropDowns->usage_location->count().' Device Master']);
                
            }
        
            if($dropDowns->gauge_statuses->count()>0)
            {
               return back()->withInput()
                         ->withErrors(['unexpected_error' => 'Unable to edit DropDowns has '.$dropDowns->usage_location->count().' Device Master']);
                
            }
        
            if($dropDowns->request_reason->count()>0)
            {
               return back()->withInput()
                         ->withErrors(['unexpected_error' => 'Unable to edit DropDowns has '.$dropDowns->request_reason->count().' Device Master']);
                
            }
            
            
            if($dropDowns->customer_type->count()>0)
            {
                return back()->withInput()
                         ->withErrors(['unexpected_error' => 'Unable to edit DropDowns has '.$dropDowns->customer_type->count().' Customer Master']);
                
            } 
                
            if($dropDowns->vendor_type->count()>0)
            {
                return back()->withInput()
                         ->withErrors(['unexpected_error' => 'Unable to edit DropDowns has '.$dropDowns->vendor_type->count().' Vendor Master']);
                
            }
        }

        return view('drop_downs.edit', compact('dropDowns','plants'));
    }

    /**
     * Update the specified drop downs in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\DropDownsFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, DropDownsFormRequest $request)
    {
        $plantcode_id = implode(',',$request->plant_id);

        try {
            
            $data = $request->getData();
            
            $data['plant_id'] = $plantcode_id;
                        
            $dropDowns = DropDowns::findOrFail($id);
            $dropDowns->update($data);

            return redirect()->route('drop_downs.drop_downs.index')
                             ->with('success_message', 'Drop Downs was successfully updated!');

        } catch (Exception $exception) {
            
           // dd($exception);

            return back()->withInput()
                         ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }        
    }

    /**
     * Remove the specified drop downs from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $dropDowns = DropDowns::findOrFail($id);

            if($dropDowns->request_reason->count()>0)
            {
                return response()->json(['status'=>false,'message' => 'Unable to delete DropDowns has '.$dropDowns->request_reason->count().' Device Master']);
                
            }
    
            if($dropDowns->gauge_statuses->count()>0)
            {
                return response()->json(['status'=>false,'message' => 'Unable to delete DropDowns has '.$dropDowns->gauge_statuses->count().' Device Master']);
                
            }
    
            if($dropDowns->usage_location->count()>0)
            {
                return response()->json(['status'=>false,'message' => 'Unable to delete DropDowns has '.$dropDowns->usage_location->count().' Device Master']);
                
            }
    
            if($dropDowns->devices_mechanism->count()>0)
            {
                return response()->json(['status'=>false,'message' => 'Unable to delete DropDowns has '.$dropDowns->devices_mechanism->count().' Device Master']);
                
            }
       
            if($dropDowns->devices_catagory->count()>0)
            {
                return response()->json(['status'=>false,'message' => 'Unable to delete DropDowns has '.$dropDowns->devices_catagory->count().' Device Master']);
                
            }
               
             if($dropDowns->devices_property->count()>0)
            {
                return response()->json(['status'=>false,'message' => 'Unable to delete DropDowns has '.$dropDowns->devices_property->count().' Device Master']);
                
            }
           
            if($dropDowns->devices_description->count()>0)
            {
                return response()->json(['status'=>false,'message' => 'Unable to delete DropDowns has '.$dropDowns->devices_description->count().' Device Master']);
                
            }
            if($dropDowns->devices_type->count()>0)
            {
                return response()->json(['status'=>false,'message' => 'Unable to delete DropDowns has '.$dropDowns->devices_type->count().' Device Master']);
                
            }
            if($dropDowns->customer_type->count()>0)
            {
                return response()->json(['status'=>false,'message' => 'Unable to delete DropDowns has '.$dropDowns->customer_type->count().' Customer Master']);
                
            } 
                
            if($dropDowns->vendor_type->count()>0)
            {
                return response()->json(['status'=>false,'message' => 'Unable to delete DropDowns has '.$dropDowns->vendor_type->count().' Vendor Master']);
                
            } 
            
            $dropDowns->delete();

            return redirect()->route('drop_downs.drop_downs.index')
                             ->with('success_message', 'Drop Downs was successfully deleted!');

        } catch (Exception $exception) {
            
            dd($exception);

            return back()->withInput()
                         ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }
    }



}
