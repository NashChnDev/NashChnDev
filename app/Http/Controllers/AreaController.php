<?php

namespace App\Http\Controllers;

use App\Models\company;
use App\Models\country;
use App\Models\state;
use App\Models\city;
use App\Models\plants;
use App\Models\area;
use App\Models\departments;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Department;
use App\Http\Requests\AreaFormRequest;
use Illuminate\Http\Request;
use Exception;
use Yajra\Datatables\Datatables;
use App\Authorizable;

class AreaController extends Controller
{
use Authorizable;
    /**
     * Display a listing of the companies.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        // $area = area::with('department')->get();
        // dd($area);
        return view('area.index');
    }

	/**
     * Process ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getIndexData()
    {
		$area = area::with('department')->get();
        
		return Datatables::of($area)
        ->addColumn('actions', function ($row) {
            $div='<div class="btn-group btn-group-sm float-right" role="group">
                    <a href="' . route('area.area.show', [$row->id]) . '" class="btn btn-sm btn-outline-info" title="Show Area">
                        <i class="fas fa-fw fa-eye" aria-hidden="true"></i>
                    </a>';
            if(auth()->user()->hasPermissionTo('edit_department'))
                $div.='<a href="' . route('area.area.edit', [$row->id]) . '" class="btn btn-sm btn-outline-success" title="Edit Area">
                        <i class="fas fa-fw fa-edit" aria-hidden="true"></i>
                    </a>';
            if(auth()->user()->hasPermissionTo('delete_department'))
                $div.='<button type="submit" class="btn btn-sm btn-outline-danger btn-delete" title="Delete company" data-remote="' . route('area.area.destroy', [$row->id]) . '" >
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
        
            // $country = country::all();
            $plant = plants::get();
         
        // dd($country);           
        return view('area.create',compact('plant'));
    }

    /**
     * Store a new company in the storage.
     *
     * @param App\Http\Requests\AreaFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(AreaFormRequest $request)
    {
        //dd($request);
        //dd($request);
        try {
            
            $data = $request->getData();
           
            area::create($data);
            return redirect()->route('area.area.index')
                             ->with('success_message', 'Area was successfully added!');

        } catch (Exception $exception) {
            //dd($exception);
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
        $area = area::findOrFail($id);

        return view('area.show', compact('area'));
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
        $department = departments::get();
        $area = area::findOrFail($id);
        
//dd($area);
        return view('area.edit', compact('area','plant','department'));
    }

    /**
     * Update the specified company in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\AreaFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, AreaFormRequest $request)
    {
      
  
        
        try {
            
            $data = $request->getData();
            $input = $request->all();
            $area = area::findOrFail($id);
            $area->update($data);

            return redirect()->route('area.area.index')
                             ->with('success_message', 'Area was successfully updated!');

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
            $area = area::findOrFail($id);
            // if($company->plants->count()>0)
            // {
            //     return response()->json(['status'=>false,'message' => 'Unable to delete Company has '.$company->plants->count().' Plants']);
            // }
            $area->delete();

            return redirect()->route('area.department.index')
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

    public function getdepartment($plant_id)
    {
        $department = departments::where('plant_id',$plant_id)->get();
        if($department!=null && count($department)>0)
            return response()->json(['status'=>'success','data'=>$department]);
        else
            return response()->json(['status'=>'error','msg'=>'Data Not Found']);
    }




}
