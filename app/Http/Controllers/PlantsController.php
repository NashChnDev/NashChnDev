<?php

namespace App\Http\Controllers;

use App\Models\plants;
use App\Models\Company;
use App\Models\country;
use App\Models\state;
use App\Models\city;
use App\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\PlantsFormRequest;
use Exception;
use Auth;
use Gate;
use Yajra\Datatables\Datatables;
use App\Authorizable;


class PlantsController extends Controller
{
     use Authorizable;

    /**
     * Display a listing of the plants.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
		return view('plants.index');
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
             $plantsObjects = plants::with('company')->get();  
         }
        else
        {
            $plantsObjects = plants::with('company')->where('plantcode', Auth::user()->plantcode_id)->get();   
        }

        
		return Datatables::of($plantsObjects)
        ->addColumn('actions', function ($row) {
            
            return '<div class="btn-group btn-group-sm float-right" role="group">
                    <a href="' . route('plants.plants.show', [$row->id]) . '" class="btn btn-sm btn-outline-primary" title="Show plants">
                        <i class="fas fa-fw fa-eye" aria-hidden="true"></i>
                    </a>
                    <a href="' . route('plants.plants.edit', [$row->id]) . '" class="btn btn-sm btn-outline-primary" title="Edit plants">
                        <i class="fas fa-fw fa-edit" aria-hidden="true"></i>
                    </a>
                    <button type="submit" class="btn btn-sm btn-outline-primary btn-delete" title="Delete plants" data-remote="' . route('plants.plants.destroy', [$row->id]) . '" >
                        <i class="fas fa-fw fa-trash-alt" aria-hidden="true"></i>
                    </button>
                </div>'; 
        })
        ->rawColumns(['actions' => 'actions'])
        ->make(true);
    }

	
    /**
     * Show the form for creating a new plants.
     *
     * @return Illuminate\View\View
     */
    public function create()    
    {
        $country = country::all();
        $companies = Company::where('company_status',"Active")->get();
       
        return view('plants.create', compact('companies','country'));
    }

    /**
     * Store a new plants in the storage.
     *
     * @param App\Http\Requests\PlantsFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(PlantsFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
           // dd($data);
            
            plants::create($data);

            return redirect()->route('plants.plants.index')
                             ->with('success_message', 'Plants was successfully added!');

        } catch (Exception $exception) {
            
            dd($exception);

            return back()->withInput()
                         ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }
    }

    /**
     * Display the specified plants.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $plants = plants::with('company')->findOrFail($id);

        return view('plants.show', compact('plants'));
    }

    /**
     * Show the form for editing the specified plants.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $country = country::all();
        $plants = plants::findOrFail($id);
        $companies = Company::where('company_status',"Active")->get();
        
        
        return view('plants.edit', compact('plants','companies','country'));
    }

    /**
     * Update the specified plants in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\PlantsFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, PlantsFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $plants = plants::findOrFail($id);
            $plants->update($data);

            return redirect()->route('plants.plants.index')
                             ->with('success_message', 'Plants was successfully updated!');

        } catch (Exception $exception) {
            
             dd($exception);

            return back()->withInput()
                         ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }        
    }

    /**
     * Remove the specified plants from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            //dd($id);
            $plants = plants::findOrFail($id);
            
            $userTable = User::where('plant_id','like','%'.$plants->plantcode.'%')->count();
            
            if($userTable>0)
            {
                return response()->json(['status'=>false,'message' => 'Unable to delete Plant has '.$userTable.' Authorized User Plant']);
                
            }
            
            //  if($plants->departments->count()>0)
            // {
            //     return response()->json(['status'=>false,'message' => 'Unable to delete Plant has '.$plants->departments->count().' Department']);
                
            // }
            // if($plants->Req_plant->count()>0)
            // {
            //     return response()->json(['status'=>false,'message' => 'Unable to delete Plant has '.$plants->Req_plant->count().' Under Request Process']);
                
            // }
            // if($plants->Issue_plant->count()>0)
            // {
            //     return response()->json(['status'=>false,'message' => 'Unable to delete Plant has '.$plants->Issue_plant->count().' Under Issue Process']);
                
            // }
            // if($plants->Calibrate_plant->count()>0)
            // {
            //     return response()->json(['status'=>false,'message' => 'Unable to delete Plant has '.$plants->Calibrate_plant->count().' Under Calibrate Process']);
                
            // }
            // if($plants->Scrap_plant->count()>0)
            // {
            //     return response()->json(['status'=>false,'message' => 'Unable to delete Plant has '.$plants->Scrap_plant->count().' Under Scrap Process']);
                
            // }
            
             
            
             //dd($id);
            $plants->delete();

            return redirect()->route('plants.plants.index')
                             ->with('success_message', 'Plants was successfully deleted!');

        } catch (Exception $exception) {
            dd($exception);
            return back()->withInput()
                         ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }
    }



}
