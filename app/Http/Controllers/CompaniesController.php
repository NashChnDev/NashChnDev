<?php

namespace App\Http\Controllers;

use App\Models\company;
use App\Models\country;
use App\Models\state;
use App\Models\city;
use App\Http\Controllers\Controller;
use App\Http\Requests\CompaniesFormRequest;
use Illuminate\Http\Request;
use Exception;
use Yajra\Datatables\Datatables;
 use App\Authorizable;

class CompaniesController extends Controller
{
    use Authorizable;

    /**
     * Display a listing of the companies.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        
		return view('companies.index');
    }

	/**
     * Process ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getIndexData()
    {
		$companies = company::with('country','state','city')->get();
        
		return Datatables::of($companies)
        ->addColumn('actions', function ($row) {
            
            return '<div class="btn-group btn-group-sm float-right" role="group">
                    <a href="' . route('companies.company.show', [$row->id]) . '" class="btn btn-sm btn-outline-primary" title="Show company">
                        <i class="fas fa-fw fa-eye" aria-hidden="true"></i>
                    </a>
                    <a href="' . route('companies.company.edit', [$row->id]) . '" class="btn btn-sm btn-outline-primary" title="Edit company">
                        <i class="fas fa-fw fa-edit" aria-hidden="true"></i>
                    </a>
                    <button type="submit" class="btn btn-sm btn-outline-primary btn-delete" title="Delete company" data-remote="' . route('companies.company.destroy', [$row->id]) . '" >
                        <i class="fas fa-fw fa-trash-alt" aria-hidden="true"></i>
                    </button>
                </div>'; 
        })
        ->rawColumns(['actions' => 'actions'])
        ->make(true);
    }

	
    /**
     * Show the form for creating a new company.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        
            $country = country::all();
           
        return view('companies.create',compact('country'));
    }

    /**
     * Store a new company in the storage.
     *
     * @param App\Http\Requests\CompaniesFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(CompaniesFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            company::create($data);

            return redirect()->route('companies.company.index')
                             ->with('success_message', 'Company was successfully added!');

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }
    }

    /**
     * Display the specified company.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $company = company::findOrFail($id);

        return view('companies.show', compact('company'));
    }

    /**
     * Show the form for editing the specified company.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $country = country::all();
        
        $company = company::findOrFail($id);
        

        return view('companies.edit', compact('company','country'));
    }

    /**
     * Update the specified company in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\CompaniesFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, CompaniesFormRequest $request)
    {
      
  
        
        try {
            
            $data = $request->getData();
            
            $company = company::findOrFail($id);
            $company->update($data);

            return redirect()->route('companies.company.index')
                             ->with('success_message', 'Company was successfully updated!');

        } catch (Exception $exception) {
            
            dd($exception);

            return back()->withInput()
                         ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }        
    }

    /**
     * Remove the specified company from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $company = company::findOrFail($id);
            
            if($company->plants->count()>0)
            {
                return response()->json(['status'=>false,'message' => 'Unable to delete Company has '.$company->plants->count().' Plants']);
                
            }
            
            $company->delete();

            return redirect()->route('companies.company.index')
                             ->with('success_message', 'Company was successfully deleted!');

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }
    }
    
    
    public function getStateDetails($id_for)
    {

        $state=state::where('country_id',$id_for)->orderBy('id','asc')->get();
        if($state!=null && count($state)>0)
            return response()->json(['status'=>'success','data'=>$state]);
        else
            return response()->json(['status'=>'error','msg'=>'Data Not Found']);
    }
    
    
        public function getCityDetails($id_for)
    {
          //  return "zddg"; 

        $city=city::where('state_id',$id_for)->orderBy('id','asc')->get();
        if($city!=null && count($city)>0)
            return response()->json(['status'=>'success','data'=>$city]);
        else
            return response()->json(['status'=>'error','msg'=>'Data Not Found']);
    }




}
