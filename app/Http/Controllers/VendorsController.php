<?php

namespace App\Http\Controllers;

use App\Models\vendors;
use App\Models\Company;
use App\Models\country;
use App\Models\DropDowns;
use App\Http\Controllers\Controller;
use App\Http\Requests\VendorsFormRequest;
use Exception;
use App\Models\Plants;
use Auth;
use Gate;
use Yajra\Datatables\Datatables;
use App\Authorizable;



class VendorsController extends Controller
{
    use Authorizable;

    /**
     * Display a listing of the vendors.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
		return view('vendors.index');
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
		  $vendorsObjects = vendors::with('optionvalue','company','country','state','city')->get();
        }
        else
        {
          $Auth_plants = explode(',',Auth::user()->plantcode_id);
          $vendorsObjects = vendors::with('optionvalue','company','country','state','city')->whereIn('plant_id', $Auth_plants)->get();
        }
        
		return Datatables::of($vendorsObjects)
        ->addColumn('actions', function ($row) {
            
            return '<div class="btn-group btn-group-sm float-right" role="group">
                    <a href="' . route('vendors.vendors.show', [$row->id]) . '" class="btn btn-sm btn-outline-primary" title="Show vendors">
                        <i class="fas fa-fw fa-eye" aria-hidden="true"></i>
                    </a>
                    <a href="' . route('vendors.vendors.edit', [$row->id]) . '" class="btn btn-sm btn-outline-primary" title="Edit vendors">
                        <i class="fas fa-fw fa-edit" aria-hidden="true"></i>
                    </a>
                    <button type="submit" class="btn btn-sm btn-outline-primary btn-delete" title="Delete vendors" data-remote="' . route('vendors.vendors.destroy', [$row->id]) . '" >
                        <i class="fas fa-fw fa-trash-alt" aria-hidden="true"></i>
                    </button>
                </div>'; 
        })
        ->rawColumns(['actions' => 'actions'])
        ->make(true);
    }

	
    /**
     * Show the form for creating a new vendors.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $Auth_plants = explode(',',Auth::user()->plantcode_id);
        
        if(Gate::allows('super_admin'))
        {
            $plants = Plants::where('status','Active')->get();
        }
        else
        {
          
          $plants = Plants::where('status','Active')->whereIn('plantcode', $Auth_plants)->get();  
        }
        $country = country::all();
        $optionvalues = DropDowns::where('fieldsname',config('constants.options_from_db')['Vendor_Types'])->Where(function ($query) use($Auth_plants) {
             for ($i = 0; $i < count($Auth_plants); $i++){
                $query->orwhere('plant_id', 'like',  '%' . $Auth_plants[$i] .'%');
             }      
        })->pluck('optionvalue','id');
        $companies = Company::where('company_status','Active')->get();
        
        return view('vendors.create', compact('optionvalues','companies','country','plants'));
    }

    /**
     * Store a new vendors in the storage.
     *
     * @param App\Http\Requests\VendorsFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(VendorsFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            vendors::create($data);

            return redirect()->route('vendors.vendors.index')
                             ->with('success_message', 'Vendors was successfully added!');

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }
    }

    /**
     * Display the specified vendors.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $vendors = vendors::with('optionvalue','company','country','state','city')->findOrFail($id);

        return view('vendors.show', compact('vendors'));
    }

    /**
     * Show the form for editing the specified vendors.
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
        }
        else
        {
          $plants = Plants::where('status','Active')->whereIn('plantcode', $Auth_plants)->get();  
        }
         $country = country::all();
        $vendors = vendors::findOrFail($id);
        $optionvalues = DropDowns::where('fieldsname',config('constants.options_from_db')['Vendor_Types'])->Where(function ($query) use($Auth_plants) {
             for ($i = 0; $i < count($Auth_plants); $i++){
                $query->orwhere('plant_id', 'like',  '%' . $Auth_plants[$i] .'%');
             }      
        })->pluck('optionvalue','id');
       $companies = Company::where('company_status','Active')->get();

        return view('vendors.edit', compact('vendors','optionvalues','companies','country','plants'));
    }

    /**
     * Update the specified vendors in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\VendorsFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, VendorsFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $vendors = vendors::findOrFail($id);
            $vendors->update($data);

            return redirect()->route('vendors.vendors.index')
                             ->with('success_message', 'Vendors was successfully updated!');

        } catch (Exception $exception) {
            
            dd($exception);

            return back()->withInput()
                         ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }        
    }

    /**
     * Remove the specified vendors from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $vendors = vendors::findOrFail($id);
            if($vendors->deviceMaster->count()>0)
            {
                return response()->json(['status'=>false,'message' => 'Unable to delete Vendor has '.$vendors->deviceMaster->count().' Device Master']);
                
            }
            $vendors->delete();

            return redirect()->route('vendors.vendors.index')
                             ->with('success_message', 'Vendors was successfully deleted!');

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }
    }



}
