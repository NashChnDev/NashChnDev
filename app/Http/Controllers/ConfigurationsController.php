<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\configurations;
use App\Http\Controllers\Controller;
use App\Http\Requests\ConfigurationsFormRequest;
use Exception;
use DB;
use Yajra\Datatables\Datatables;
use App\Authorizable;

class ConfigurationsController extends Controller
{
   // use Authorizable;

    /**
     * Display a listing of the configurations.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        
        $configs = configurations::paginate(15);
		return view('configurations.index',compact('configs'));
    }

	/**
     * Process ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getIndexData()
    {
		$configurationsObjects = configurations::with('company')->get();
        
		return Datatables::of($configurationsObjects)
        ->addColumn('actions', function ($row) {
            
            return '<div class="btn-group btn-group-sm float-right" role="group">
                    <a href="' . route('configurations.configurations.show', [$row->id]) . '" class="btn btn-sm btn-outline-primary" title="Show configurations">
                        <i class="fas fa-fw fa-eye" aria-hidden="true"></i>
                    </a>
                    <a href="' . route('configurations.configurations.edit', [$row->id]) . '" class="btn btn-sm btn-outline-primary" title="Edit configurations">
                        <i class="fas fa-fw fa-edit" aria-hidden="true"></i>
                    </a>
                    <button type="submit" class="btn btn-sm btn-outline-primary btn-delete" title="Delete configurations" data-remote="' . route('configurations.configurations.destroy', [$row->id]) . '" >
                        <i class="fas fa-fw fa-trash-alt" aria-hidden="true"></i>
                    </button>
                </div>'; 
        })
        ->rawColumns(['actions' => 'actions'])
        ->make(true);
    }

	
    /**
     * Show the form for creating a new configurations.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $companies = Company::where('company_status','Active')->pluck('company_name','company_code','id');
        
        return view('configurations.create', compact('companies'));
    }

    /**
     * Store a new configurations in the storage.
     *
     * @param App\Http\Requests\ConfigurationsFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(ConfigurationsFormRequest $request)
    {
        //dd($request->all());
        try {
            
            $data = $request->getData();
            
            configurations::create($data);

            return redirect()->route('configurations.configurations.index')
                             ->with('success_message', 'Configurations was successfully added!');

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }
    }

    /**
     * Display the specified configurations.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $configurations = configurations::with('company')->findOrFail($id);

        return view('configurations.show', compact('configurations'));
    }

    /**
     * Show the form for editing the specified configurations.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $configurations = configurations::findOrFail($id);
        $companies = Company::pluck('created_at','id')->all();

        return view('configurations.edit', compact('configurations','companies'));
    }

    /**
     * Update the specified configurations in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\ConfigurationsFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, ConfigurationsFormRequest $request)
    {
        //dd($request->getData());
        try {
            
            $data = $request->getData();
            
            $configurations = configurations::findOrFail($id);
            $configurations->update($data);

            return redirect()->route('configurations.configurations.index')
                             ->with('success_message', 'Configurations was successfully updated!');

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }        
    }

    /**
     * Remove the specified configurations from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $configurations = configurations::findOrFail($id);
            $configurations->delete();

            return redirect()->route('configurations.configurations.index')
                             ->with('success_message', 'Configurations was successfully deleted!');

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }
    }
    
    public function autosave($Gauge_Request_Number)
    {
        
        
        $reqprefix = request('reqprefix');
        $reqsuffix = request('reqsuffix');
        
        $update = DB::table('configurations')->where('key',$Gauge_Request_Number)->update(['reqprefix'=>$reqprefix,'reqsuffix'=>$reqsuffix]);
        
        if($update)
        {
            return response()->json(['status'=>0, 'msg'=>"Update Successfully"]);
        }
        else
        {
            return response()->json(['status'=>1, 'msg'=>"Not Update"]);
        }
        
        
        
        
    }



}
