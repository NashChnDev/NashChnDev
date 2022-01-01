<?php

namespace App\Http\Controllers;

use App\Models\Ranges;
use App\Http\Controllers\Controller;
use App\Http\Requests\RangesFormRequest;
use Exception;
use Yajra\Datatables\Datatables;

class RangesController extends Controller
{

    /**
     * Display a listing of the ranges.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
		return view('ranges.index');
    }

	/**
     * Process ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getIndexData()
    {
		$rangesObjects = Ranges::get();
        
		return Datatables::of($rangesObjects)
        ->addColumn('actions', function ($row) {
            
            return '<div class="btn-group btn-group-sm float-right" role="group">
                    <a href="' . route('ranges.ranges.show', [$row->id]) . '" class="btn btn-sm btn-outline-warning" title="Show Ranges">
                        <i class="fas fa-fw fa-eye" aria-hidden="true"></i>
                    </a>
                    <a href="' . route('ranges.ranges.edit', [$row->id]) . '" class="btn btn-sm btn-outline-primary" title="Edit Ranges">
                        <i class="fas fa-fw fa-edit" aria-hidden="true"></i>
                    </a>
                    <button type="submit" class="btn btn-sm btn-outline-danger btn-delete" title="Delete Ranges" data-remote="' . route('ranges.ranges.destroy', [$row->id]) . '" >
                        <i class="fas fa-fw fa-trash-alt" aria-hidden="true"></i>
                    </button>
                </div>'; 
        })
        ->rawColumns(['actions' => 'actions'])
        ->make(true);
    }

	
    /**
     * Show the form for creating a new ranges.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        
        
        return view('ranges.create');
    }

    /**
     * Store a new ranges in the storage.
     *
     * @param App\Http\Requests\RangesFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(RangesFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            Ranges::create($data);

            return redirect()->route('ranges.ranges.index')
                             ->with('success_message', 'Ranges was successfully added!');

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }
    }

    /**
     * Display the specified ranges.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $ranges = Ranges::findOrFail($id);

        return view('ranges.show', compact('ranges'));
    }

    /**
     * Show the form for editing the specified ranges.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $ranges = Ranges::findOrFail($id);
        

        return view('ranges.edit', compact('ranges'));
    }

    /**
     * Update the specified ranges in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\RangesFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, RangesFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $ranges = Ranges::findOrFail($id);
            $ranges->update($data);

            return redirect()->route('ranges.ranges.index')
                             ->with('success_message', 'Ranges was successfully updated!');

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }        
    }

    /**
     * Remove the specified ranges from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $ranges = Ranges::findOrFail($id);
            $ranges->delete();

            return redirect()->route('ranges.ranges.index')
                             ->with('success_message', 'Ranges was successfully deleted!');

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }
    }



}
