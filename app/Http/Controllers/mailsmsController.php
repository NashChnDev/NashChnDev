<?php

namespace App\Http\Controllers;

use App\Models\mailsms;
use App\Models\plants;
use App\Http\Controllers\Controller;
use App\Http\Requests\mailsmsFormRequest;
use Exception;
use Auth;
use Gate;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;
use App\Authorizable;


class mailsmsController extends Controller
{
   // use Authorizable;

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
		return view('mailsms.index',compact('plants'));
    }

	/**
     * Process ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getIndexData(Request $req)
    {
        $option_name=$req->get('option_name');
        
        // dd($option_name);
        
        if(Gate::allows('super_admin'))
        {
        $mailsmsObjects = mailsms::where('fieldsname',$option_name)->get();
        }
        else
        {
        $mailsmsObjects = mailsms::where('fieldsname',$option_name)->where('plant_id', Auth::user()->plantcode_id)->get();
        }
		return Datatables::of($mailsmsObjects)
        ->addColumn('actions', function ($row) {
            
            return '<div class="btn-group btn-group-sm float-right" role="group">
                    <a href="' . route('mailsms.mailsms.show', [$row->id]) . '" class="btn btn-sm btn-outline-warning" title="Show mailsms">
                        <i class="fas fa-fw fa-eye" aria-hidden="true"></i>
                    </a>
                    <a href="' . route('mailsms.mailsms.edit', [$row->id]) . '" class="btn btn-sm btn-outline-primary" title="Edit mailsms">
                        <i class="fas fa-fw fa-edit" aria-hidden="true"></i>
                    </a>
                    <button type="submit" class="btn btn-sm btn-outline-danger btn-delete" title="Delete mailsms" data-remote="' . route('mailsms.mailsms.destroy', [$row->id]) . '" >
                        <i class="fas fa-fw fa-trash-alt" aria-hidden="true"></i>
                    </button>
                </div>'; 
        })
        ->rawColumns(['actions' => 'actions'])
        ->make(true);
    }
    
    
    public function getexpirealertmailIndexData(Request $req)
    {
       
        $option_name=$req->get('option_name');
        
         // dd($option_name);
        
        if(Gate::allows('super_admin'))
        {
        $expirealertmailObjects = mailsms::where('fieldsname',$option_name)->get();
        }
        else
        {
        $expirealertmailObjects = mailsms::where('fieldsname',$option_name)->where('plant_id', Auth::user()->plantcode_id)->get();
        }
        
       // dd($expirealertmailObjects);
        
		return Datatables::of($expirealertmailObjects)
        ->addColumn('actions', function ($row) {
            
            return '<div class="btn-group btn-group-sm float-right" role="group">
                    <a href="' . route('mailsms.mailsms.show', [$row->id]) . '" class="btn btn-sm btn-outline-warning" title="Show mailsms">
                        <i class="fas fa-fw fa-eye" aria-hidden="true"></i>
                    </a>
                    <a href="' . route('mailsms.mailsms.edit', [$row->id]) . '" class="btn btn-sm btn-outline-primary" title="Edit mailsms">
                        <i class="fas fa-fw fa-edit" aria-hidden="true"></i>
                    </a>
                    <button type="submit" class="btn btn-sm btn-outline-danger btn-delete" title="Delete mailsms" data-remote="' . route('mailsms.mailsms.destroy', [$row->id]) . '" >
                        <i class="fas fa-fw fa-trash-alt" aria-hidden="true"></i>
                    </button>
                </div>'; 
        })
        ->rawColumns(['actions' => 'actions'])
        ->make(true);
        
    }
    
    public function getalertsmsData(Request $req)
    {
           
        $option_name=$req->get('option_name');
        
         // dd($option_name);
        
        if(Gate::allows('super_admin'))
        {
        $getalertsmsDataObjects = mailsms::where('fieldsname',$option_name)->get();
        }
        else
        {
        $getalertsmsDataObjects = mailsms::where('fieldsname',$option_name)->where('plant_id', Auth::user()->plantcode_id)->get();
        }
        
       // dd($expirealertmailObjects);
        
		return Datatables::of($getalertsmsDataObjects)
        ->addColumn('actions', function ($row) {
            
            return '<div class="btn-group btn-group-sm float-right" role="group">
                    <a href="' . route('mailsms.mailsms.show', [$row->id]) . '" class="btn btn-sm btn-outline-warning" title="Show mailsms">
                        <i class="fas fa-fw fa-eye" aria-hidden="true"></i>
                    </a>
                    <a href="' . route('mailsms.mailsms.edit', [$row->id]) . '" class="btn btn-sm btn-outline-primary" title="Edit mailsms">
                        <i class="fas fa-fw fa-edit" aria-hidden="true"></i>
                    </a>
                    <button type="submit" class="btn btn-sm btn-outline-danger btn-delete" title="Delete mailsms" data-remote="' . route('mailsms.mailsms.destroy', [$row->id]) . '" >
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
        
        return view('mailsms.create',compact('plants'));
    }

    /**
     * Store a new drop downs in the storage.
     *
     * @param App\Http\Requests\mailsmsFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(mailsmsFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            mailsms::create($data);

            return redirect()->route('mailsms.mailsms.index')
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
        $mailsms = mailsms::findOrFail($id);

        return view('mailsms.show', compact('mailsms'));
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
        if(Gate::allows('super_admin'))
        {
        $plants = Plants::where('status','Active')->get();
        }
        else
        {
          $plants = Plants::where('status','Active')->where('plantcode', Auth::user()->plantcode_id)->get();  
        }
        $mailsms = mailsms::findOrFail($id);
        

        return view('mailsms.edit', compact('mailsms','plants'));
    }

    /**
     * Update the specified drop downs in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\mailsmsFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, mailsmsFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $mailsms = mailsms::findOrFail($id);
            $mailsms->update($data);

            return redirect()->route('mailsms.mailsms.index')
                             ->with('success_message', 'Drop Downs was successfully updated!');

        } catch (Exception $exception) {

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
            
            $mailsms = mailsms::findOrFail($id);
                        
            $mailsms->delete();

            return redirect()->route('mailsms.mailsms.index')
                             ->with('success_message', 'Drop Downs was successfully deleted!');

        } catch (Exception $exception) {
            
            dd($exception);

            return back()->withInput()
                         ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }
    }



}
