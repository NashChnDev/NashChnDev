<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\customer;
use App\Models\country;
use App\Models\DropDowns;
use App\Models\Plants;
use App\Http\Controllers\Controller;
use App\Http\Requests\CustomersFormRequest;
use Exception;
use Auth;
use Gate;
use Yajra\Datatables\Datatables;
use App\Authorizable;


class CustomersController extends Controller
{

    use Authorizable;
    /**
     * Display a listing of the customers.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
		return view('customers.index');
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
		  $customers = customer::with('optionvalue','company','country','state','city')->get();
        }
        else
        {
          $Auth_plants = explode(',',Auth::user()->plantcode_id);
          $customers = customer::with('optionvalue','company','country','state','city')->whereIn('plant_id',$Auth_plants)->get(); 
        }
        
		return Datatables::of($customers)
        ->addColumn('actions', function ($row) {
            
            return '<div class="btn-group btn-group-sm float-right" role="group">
                    <a href="' . route('customers.customer.show', [$row->id]) . '" class="btn btn-sm btn-outline-primary" title="Show customer">
                        <i class="fas fa-fw fa-eye" aria-hidden="true"></i>
                    </a>
                    <a href="' . route('customers.customer.edit', [$row->id]) . '" class="btn btn-sm btn-outline-primary" title="Edit customer">
                        <i class="fas fa-fw fa-edit" aria-hidden="true"></i>
                    </a>
                    <button type="submit" class="btn btn-sm btn-outline-primary btn-delete" title="Delete customer" data-remote="' . route('customers.customer.destroy', [$row->id]) . '" >
                        <i class="fas fa-fw fa-trash-alt" aria-hidden="true"></i>
                    </button>
                </div>'; 
        })
        ->rawColumns(['actions' => 'actions'])
        ->make(true);
    }

	
    /**
     * Show the form for creating a new customer.
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
        
        $optionvalues = DropDowns::where('fieldsname',config('constants.options_from_db')['Customer_Types'])->Where(function ($query) use($Auth_plants) {
             for ($i = 0; $i < count($Auth_plants); $i++){
                $query->orwhere('plant_id', 'like',  '%' . $Auth_plants[$i] .'%');
             }      
        })->pluck('optionvalue','id');
        
        $companies = Company::where('company_status','Active')->get();
        
        
        
        return view('customers.create', compact('companies','country','optionvalues','plants'));
    }

    /**
     * Store a new customer in the storage.
     *
     * @param App\Http\Requests\CustomersFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(CustomersFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
          // dd($data);
            
            customer::create($data);

            return redirect()->route('customers.customer.index')
                             ->with('success_message', 'Customer was successfully added!');

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }
    }

    /**
     * Display the specified customer.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $customer = customer::with('optionvalue','company','country','state','city')->findOrFail($id);

        return view('customers.show', compact('customer'));
    }

    /**
     * Show the form for editing the specified customer.
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
        $optionvalues = DropDowns::where('fieldsname',config('constants.options_from_db')['Customer_Types'])->Where(function ($query) use($Auth_plants) {
             for ($i = 0; $i < count($Auth_plants); $i++){
                $query->orwhere('plant_id', 'like',  '%' . $Auth_plants[$i] .'%');
             }      
        })->pluck('optionvalue','id');
        $customer = customer::findOrFail($id);
        $companies = Company::where('company_status','Active')->get();
        
        //dd($customer);

        return view('customers.edit', compact('customer','companies','country','optionvalues','plants'));
    }

    /**
     * Update the specified customer in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\CustomersFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, CustomersFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $customer = customer::findOrFail($id);
            $customer->update($data);

            return redirect()->route('customers.customer.index')
                             ->with('success_message', 'Customer was successfully updated!');

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }        
    }

    /**
     * Remove the specified customer from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $customer = customer::findOrFail($id);
                if($customer->deviceMaster->count()>0)
            {
                return response()->json(['status'=>false,'message' => 'Unable to delete Customer has '.$customer->deviceMaster->count().' Device Master']);
                
            }
            $customer->delete();

            return redirect()->route('customers.customer.index')
                             ->with('success_message', 'Customer was successfully deleted!');

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }
    }



}
