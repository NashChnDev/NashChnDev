<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\company;
use App\Models\country;
use App\Models\state;
use App\Models\city;
use App\Models\plants;
use App\Models\area;
use App\Models\sub_area;
use App\Models\departments;
use App\Http\Controllers\Controller;
use App\Http\Requests\SubareaFormRequest;
use Exception;
use Yajra\Datatables\Datatables;
use App\Authorizable;

class SubareaController extends Controller
{
    use Authorizable;
    /**
     * Display a listing of the companies.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $plant = plants::with('company')->get();
        $country = country::all();
        $area = area::with('department')->get();
        // dd($area);
        return view('sub_area.index',compact('plant','country','area'));
    }

	/**
     * Process ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getIndexData()
    {
		$sub_area = sub_area::with('department','area')->get();
        
		return Datatables::of($sub_area)
        ->addColumn('actions', function ($row) {
            $div='<div class="btn-group btn-group-sm float-right" role="group">
                    <a href="' . route('sub_area.sub_area.show', [$row->id]) . '" class="btn btn-sm btn-outline-info" title="Show sub area">
                        <i class="fas fa-fw fa-eye" aria-hidden="true"></i>
                    </a>';
            if(auth()->user()->hasPermissionTo('edit_sub_area'))
                $div.='<a href="' . route('sub_area.sub_area.edit', [$row->id]) . '" class="btn btn-sm btn-outline-success" title="Edit sub area">
                        <i class="fas fa-fw fa-edit" aria-hidden="true"></i>
                    </a>';
            if(auth()->user()->hasPermissionTo('delete_sub_area'))
                $div.='<button type="submit" class="btn btn-sm btn-outline-danger btn-delete" title="Delete sub area" data-remote="' . route('sub_area.sub_area.destroy', [$row->id]) . '" >
                        <i class="fas fa-fw fa-trash-alt" aria-hidden="true"></i>
                    </button>';
            return $div.'</div>';
        })
        ->rawColumns(['actions' => 'actions'])
        ->make(true);
    }

    public function create()
    {
        
            // $country = country::all();
            $plant = plants::get();
            // $area = area::get();
         //dd($plant);
                  
        return view('sub_area.create',compact('plant'));
    }
     /**
     * Store a new company in the storage.
     *
     * @param App\Http\Requests\SubareaFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(SubareaFormRequest $request)
    {
        // dd($plant); 
        // dd($request);
        //dd($request);
        try {
            
            $data = $request->getData();
           
            sub_area::create($data);
            return redirect()->route('sub_area.sub_area.index')
                             ->with('success_message', 'Sub Area was successfully added!');

        } catch (Exception $exception) {
            dd($exception);
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
        $sub_area = sub_area::findOrFail($id);

        return view('sub_area.show', compact('sub_area'));
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
        $area = area::get();
        $sub_area = sub_area::findOrFail($id);
        
//dd($area);
        return view('sub_area.edit', compact('plant','area','sub_area'));
    }

    /**
     * Update the specified company in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\SubareaFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, SubareaFormRequest $request)
    {
      
  
        
        try {
            
            $data = $request->getData();
            
            $sub_area = sub_area::findOrFail($id);
            $input = $request->all();
            $sub_area->update($data);
            

            return redirect()->route('sub_area.sub_area.index')
                             ->with('success_message', 'sub area was successfully updated!');

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
            $sub_area = sub_area::findOrFail($id);
            // if($company->plants->count()>0)
            // {
            //     return response()->json(['status'=>false,'message' => 'Unable to delete Company has '.$company->plants->count().' Plants']);
            // }
            $sub_area->delete();

            return redirect()->route('sub_area.department.index')
                             ->with('success_message', 'sub area was successfully deleted!');

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
    public function getarea($plant,$dept)
    {
        $area = area::where('plantcode',$plant)->where('departmentcode',$dept)->get();
        //dd($area);
        if($area!=null && count($area)>0)
        return response()->json(['status'=>'success','data'=>$area]);
          else
        return response()->json(['status'=>'error','msg'=>'Data Not Found']);
    }



}
