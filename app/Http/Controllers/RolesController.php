<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\RolesFormRequest;
use Exception;
use Yajra\Datatables\Datatables;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Authorizable;
use Auth;
class RolesController extends Controller
{
    use Authorizable;
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
     * Display a listing of the roles.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
		return view('roles.index');
    }

	/**
     * Process ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getIndexData()
    {
		$roles = Role::with('permissions')->whereNotIn('id',Auth::user()->roles->pluck('id')->all())->withCount('users')->get();
        
		return Datatables::of($roles)
        ->addColumn('actions', function ($row) {
            $div='<div class="btn-group btn-group-sm float-right" role="group">
                    <a href="' . route('roles.role.show', [$row->id]) . '" class="btn btn-sm btn-outline-info" title="Show Role">
                        <i class="fas fa-fw fa-eye" aria-hidden="true"></i>
                    </a>';
            if(auth()->user()->hasPermissionTo('edit_roles'))
                $div.='<a href="' . route('roles.role.edit', [$row->id]) . '" class="btn btn-sm btn-outline-success" title="Edit Role">
                        <i class="fas fa-fw fa-edit" aria-hidden="true"></i>
                    </a>';
            if(auth()->user()->hasPermissionTo('delete_roles'))
                $div.='<button type="submit" class="btn btn-sm btn-outline-danger btn-delete" title="Delete Role" data-remote="' . route('roles.role.destroy', [$row->id]) . '" >
                        <i class="fas fa-fw fa-trash-alt" aria-hidden="true"></i>
                    </button>';
            return $div.'</div>';
        })
        ->rawColumns(['actions' => 'actions'])
        ->make(true);
    }

	
    /**
     * Show the form for creating a new role.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        return view('roles.create');
    }

    /**
     * Store a new role in the storage.
     *
     * @param App\Http\Requests\RolesFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(RolesFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            // dd($data);
            $roledata['name']=$data['name'];
            $roledata['guard_name']=$data['guard_name'];
            if(Role::where('name',$roledata['name'])->where('guard_name',$roledata['guard_name'])->count()>0)
            {
            return back()->withInput()->withErrors(['unexpected_error' => 'Role Name '.$roledata['name'].' Already Exists']);
            }
            $role=Role::create($roledata);
            if($roledata['guard_name']=='api')
            {
                $role->syncPermissions(Permission::where('guard_name','api')->get()->pluck('id')->all());
            }
            else
            {
                if(isset($data['permission_flag'])&&count($data['permission_flag'])>0)
                    $role->syncPermissions($data['permission_flag']);
            }
            
            return redirect()->route('roles.role.index')
                             ->with('success_message','Role was successfully added.');

        } catch (Exception $exception) {
            // dd($exception);
            return back()->withInput()
                         ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Display the specified role.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $role = Role::findOrFail($id);

        return view('roles.show', compact('role'));
    }

    /**
     * Show the form for editing the specified role.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $role = Role::findOrFail($id);
        

        return view('roles.edit', compact('role'));
    }

    /**
     * Update the specified role in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\RolesFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, RolesFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $role = Role::findOrFail($id);
            $roledata['name']=$data['name'];
            $roledata['guard_name']=$data['guard_name'];
            $role->update($roledata);
            if($roledata['guard_name']=='api')
            {
                $role->syncPermissions(Permission::where('guard_name','api')->get()->pluck('id')->all());
            }
            else
                $role->syncPermissions($data['permission_flag']);
            return redirect()->route('roles.role.index')
                             ->with('success_message', 'Role was successfully updated.');

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }        
    }

    /**
     * Remove the specified role from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $role = Role::findOrFail($id);
            $role->delete();

            return redirect()->route('roles.role.index')
                             ->with('success_message', 'Role was successfully deleted.');

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    public function getPermissionByScope($name)
    {
        $permissions=Permission::where('guard_name',$name)->get();
        return response()->json(['permissions'=>$permissions]);
    }
}
