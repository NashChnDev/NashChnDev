<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\UsersFormRequest;
use Exception;
use Yajra\Datatables\Datatables;
use Spatie\Permission\Models\Role;
// use Spatie\Permission\Models\Permission;
use App\Models\Company;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\departments;
use App\Models\area;

class UsersController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
	public function __construct()
	{
	    $this->middleware('auth');
	}

    /**
     * Display a listing of the users.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
		return view('users.index');
    }

	/**
     * Process ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getIndexData()
    {
		$users = User::with(['plant']);
        if(!auth()->user()->hasPermissionTo('view_plants'))
            $users->where('plant_id',optional(auth()->user()->plant)->id);
		return Datatables::of($users->get())
        ->addColumn('actions', function ($row) {
            $div='<div class="btn-group btn-group-sm float-right" role="group">
                    <a href="' . route('users.user.show', [$row->id]) . '" class="btn btn-sm btn-outline-info" title="Show User">
                        <i class="fas fa-fw fa-eye" aria-hidden="true"></i>
                    </a>';
            if(auth()->user()->hasPermissionTo('edit_users'))
                $div.='<a href="' . route('users.user.edit', [$row->id]) . '" class="btn btn-sm btn-outline-success" title="Edit User">
                        <i class="fas fa-fw fa-edit" aria-hidden="true"></i>
                    </a>';
            if(auth()->user()->hasPermissionTo('delete_users'))
                $div.='<button type="submit" class="btn btn-sm btn-outline-danger btn-delete" title="Delete User" data-remote="' . route('users.user.destroy', [$row->id]) . '" >
                        <i class="fas fa-fw fa-trash-alt" aria-hidden="true"></i>
                    </button>';
            return $div.'</div>';
        })
        ->addColumn('roles',function($row){
            return implode(',',$row->roles->pluck('name')->all());
        })
        ->rawColumns(['actions' => 'actions'])
        ->make(true);
    }


    /**
     * Show the form for creating a new user.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $companies=Company::with('plants')->get();
        $roles=Role::all();
        return view('users.create',compact('companies','roles'));
    }

    /**
     * Store a new user in the storage.
     *
     * @param App\Http\Requests\UsersFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(UsersFormRequest $request)
    {
        //dd($request->getData());
        try {

            $data = $request->getData();
            $mRole=Role::findOrFail($data['role_id']);

            if(!empty($data['user_plants'])){
                $data['user_plants'] = implode(",",$data['user_plants']);
            }
            if(!empty($data['user_departs'])){
                $data['user_departs'] = implode(",",$data['user_departs']);
            }
            if(!empty($data['user_areas'])){
                $data['user_areas'] = implode(",",$data['user_areas']);
            }
            if(!empty($data['user_approve'])){
                $data['user_approve'] = implode(",",$data['user_approve']);
            }
            $user=User::create($data);
            $user->syncRoles([$data['role_id']]);
            return redirect()->route('users.user.index')
                             ->with('success_message', 'User was successfully added!');

        } catch (Exception $exception) {
            dd($exception);

            return back()->withInput()
                         ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }
    }

    /**
     * Display the specified user.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $user = User::findOrFail($id);

        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified user.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $companies=Company::with('plants')->get();
        $roles=Role::all();
        return view('users.edit', compact('user','companies','roles'));
    }

    /**
     * Update the specified user in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\UsersFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, UsersFormRequest $request)
    {
        try {

            $data = $request->getData();
            if(!empty($data['user_plants'])){
                $data['user_plants'] = implode(",",$data['user_plants']);
            }
            if(!empty($data['user_departs'])){
                $data['user_departs'] = implode(",",$data['user_departs']);
            }
            if(!empty($data['user_areas'])){
                $data['user_areas'] = implode(",",$data['user_areas']);
            }
            if(!empty($data['user_approve'])){
                $data['user_approve'] = implode(",",$data['user_approve']);
            }
            $user = User::findOrFail($id);
            $user->update($data);
            $user->syncRoles([$data['role_id']]);
            return redirect()->route('users.user.index')
                             ->with('success_message', 'User was successfully updated!');

        } catch (Exception $exception) {
            // dd($exception);
            return back()->withInput()
                         ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }
    }

    /**
     * Remove the specified user from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();

            return redirect()->route('users.user.index')
                             ->with('success_message', 'User was successfully deleted!');

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }
    }
public function changepassword($id,Request $request)
{
    try {
            $user = User::findOrFail($id);

            // dd($request->get('password'));
            $user->update(['password'=>Hash::make($request->get('password'))]);
            return back()->with('success_message', 'Password was successfully updated!');

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }
}

public function getdepartment(Request $request){
    //dd($request);
    $input = $request->all();
    // dd($input);
    if(!empty($input)){
        //$inputdata = implode(",",$input);
        $department = departments::whereIN('plant_id',$input)->get();
        if($department!=null && count($department)>0)
            return response()->json(['status'=>'success','data'=>$department]);
        else
            return response()->json(['status'=>'error','msg'=>'Data Not Found']);
    }
}
public function getarea(Request $request){
    //dd($request);
    $input = $request->all();
    // dd($input);
    if(!empty($input)){
        //$inputdata = implode(",",$input);
        $area = area::whereIN('departmentcode',$input)->get();
        if($area!=null && count($area)>0)
            return response()->json(['status'=>'success','data'=>$area]);
        else
            return response()->json(['status'=>'error','msg'=>'Data Not Found']);
    }
}
// public function getrefreshdata(Request $request){
//     $input = $request->all();
//     dd($input);
// }


}
