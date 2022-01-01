<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\plants;
use DB;
use Yajra\Datatables\Datatables;
class ResignerController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {  
        $plants = Plants::where('status','Active')->get();
        return view('Resigner.index',compact('plants'));
    }
    public function store(Request $request)
    {
        $input = $request->all();
        $id = DB::table('resigner')->insertGetId($input);        
        if($id){
            return response()->json(['Success'=>'Success','idvalue'=> $id]);
        }
    }
    public function getdata(){
        $data = DB::table('resigner')->get();
        
        // return response()->json(['Success'=>'Success','Details'=> $data]);
        if($data !=  ""){
            return Datatables::of($data)
            ->addColumn('actions', function ($row) {
                
                return '<div class="btn-group btn-group-sm float-right" role="group">
                <a class="btn btn-sm btn-outline-primary checklistmodel" data-toggle="modal" id="'.$row->id.'">
                <i class="fa fa-address-card" aria-hidden="true" style="color:#20a8d8"></i>   
                </a>
                
                         <a href="' . route('joiningform.joiningform.personal', [$row->id]) . '" class="btn btn-sm btn-outline-primary" title="Show gaugerequestheader">
                            <i class="fas fa-fw fa-eye" aria-hidden="true"></i>
                        </a>                   
                                           
                        </div>'; 
            })
            ->rawColumns(['actions' => 'actions'])
            ->make(true);
        }
       
    }
}
