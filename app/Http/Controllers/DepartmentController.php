<?php

namespace App\Http\Controllers;

use App\Models\company;
use App\Models\country;
use App\Models\state;
use App\Models\city;
use App\Models\plants;
use App\Models\departments;

use App\Http\Controllers\Controller;
use App\Http\Requests\DepartmentsFormRequest;
use Illuminate\Http\Request;
use Exception;
use Yajra\Datatables\Datatables;
use App\Authorizable;
use App\Models\DropDowns;

class DepartmentController extends Controller
{
use Authorizable;
    /**
     * Display a listing of the companies.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        
		return view('departments.index');
    }

	/**
     * Process ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getIndexData()
    {
		$departments = departments::get();
        
		return Datatables::of($departments)
        ->addColumn('actions', function ($row) {
            $div='<div class="btn-group btn-group-sm float-right" role="group">
                    <a href="' . route('department.department.show', [$row->id]) . '" class="btn btn-sm btn-outline-info" title="Show Department">
                        <i class="fas fa-fw fa-eye" aria-hidden="true"></i>
                    </a>';
            if(auth()->user()->hasPermissionTo('edit_department'))
                $div.='<a href="' . route('department.department.edit', [$row->id]) . '" class="btn btn-sm btn-outline-success" title="Edit Department">
                        <i class="fas fa-fw fa-edit" aria-hidden="true"></i>
                    </a>';
            if(auth()->user()->hasPermissionTo('delete_department'))
                $div.='<button type="submit" class="btn btn-sm btn-outline-danger btn-delete" title="Delete company" data-remote="' . route('department.department.destroy', [$row->id]) . '" >
                        <i class="fas fa-fw fa-trash-alt" aria-hidden="true"></i>
                    </button>';
            return $div.'</div>';
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
        //dd(auth()->user()->id);
        
            $country = country::all();
            $plant = plants::get();
            $dropdowns = DropDowns::all(); 
        // dd($country);           
        return view('departments.create',compact('plant','dropdowns'));
    }

    /**
     * Store a new company in the storage.
     *
     * @param App\Http\Requests\CompaniesFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(DepartmentsFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            departments::create($data);
            return redirect()->route('department.department.index')
                             ->with('success_message', 'Department was successfully added!');

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
        $department = departments::findOrFail($id);

        return view('departments.show', compact('department'));
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
        $plant = plants::get(); 
        
        $department = departments::findOrFail($id);
        $dropdowns = DropDowns::all(); 

        return view('departments.edit', compact('department','plant','dropdowns'));
    }

    /**
     * Update the specified company in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\DepartmentsFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, DepartmentsFormRequest $request)
    {
      
  
        
        try {
            
            $data = $request->getData();
            
            $department = departments::findOrFail($id);
            $department->update($data);

            return redirect()->route('department.department.index')
                             ->with('success_message', 'Department was successfully updated!');

        } catch (Exception $exception) {

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
            $department = departments::findOrFail($id);
            // if($company->plants->count()>0)
            // {
            //     return response()->json(['status'=>false,'message' => 'Unable to delete Company has '.$company->plants->count().' Plants']);
            // }
            $department->delete();

            return redirect()->route('departments.department.index')
                             ->with('success_message', 'department was successfully deleted!');

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
