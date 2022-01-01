<?php

namespace App\Http\Controllers;

use App\Models\DropDowns;
use App\Models\LeastCountMasters;
use App\Http\Controllers\Controller;
use App\Http\Requests\LeastCountMastersFormRequest;
use Exception;
use Yajra\Datatables\Datatables;

class LeastCountMastersController extends Controller
{

    /**
     * Display a listing of the least count masters.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
		return view('least_count_masters.index');
    }

	/**
     * Process ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getIndexData()
    {
		$leastCountMastersObjects = LeastCountMasters::with('uom')->get();
        
		return Datatables::of($leastCountMastersObjects)
        ->addColumn('actions', function ($row) {
            
            return '<div class="btn-group btn-group-sm float-right" role="group">
                    <a href="' . route('least_count_masters.least_count_masters.show', [$row->id]) . '" class="btn btn-sm btn-outline-warning" title="Show LeastCountMasters">
                        <i class="fas fa-fw fa-eye" aria-hidden="true"></i>
                    </a>
                    <a href="' . route('least_count_masters.least_count_masters.edit', [$row->id]) . '" class="btn btn-sm btn-outline-primary" title="Edit LeastCountMasters">
                        <i class="fas fa-fw fa-edit" aria-hidden="true"></i>
                    </a>
                    <button type="submit" class="btn btn-sm btn-outline-danger btn-delete" title="Delete LeastCountMasters" data-remote="' . route('least_count_masters.least_count_masters.destroy', [$row->id]) . '" >
                        <i class="fas fa-fw fa-trash-alt" aria-hidden="true"></i>
                    </button>
                </div>'; 
        })
        ->rawColumns(['actions' => 'actions'])
        ->make(true);
    }

	
    /**
     * Show the form for creating a new least count masters.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $uoms = DropDowns::pluck('optionvalue','id')->all();
        
        return view('least_count_masters.create', compact('uoms'));
    }

    /**
     * Store a new least count masters in the storage.
     *
     * @param App\Http\Requests\LeastCountMastersFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(LeastCountMastersFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            LeastCountMasters::create($data);

            return redirect()->route('least_count_masters.least_count_masters.index')
                             ->with('success_message', 'Least Count Masters was successfully added!');

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }
    }

    /**
     * Display the specified least count masters.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $leastCountMasters = LeastCountMasters::with('uom')->findOrFail($id);

        return view('least_count_masters.show', compact('leastCountMasters'));
    }

    /**
     * Show the form for editing the specified least count masters.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $leastCountMasters = LeastCountMasters::findOrFail($id);
        $uoms = DropDowns::pluck('optionvalue','id')->all();

        return view('least_count_masters.edit', compact('leastCountMasters','uoms'));
    }

    /**
     * Update the specified least count masters in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\LeastCountMastersFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, LeastCountMastersFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $leastCountMasters = LeastCountMasters::findOrFail($id);
            $leastCountMasters->update($data);

            return redirect()->route('least_count_masters.least_count_masters.index')
                             ->with('success_message', 'Least Count Masters was successfully updated!');

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }        
    }

    /**
     * Remove the specified least count masters from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $leastCountMasters = LeastCountMasters::findOrFail($id);
            $leastCountMasters->delete();

            return redirect()->route('least_count_masters.least_count_masters.index')
                             ->with('success_message', 'Least Count Masters was successfully deleted!');

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }
    }



}
