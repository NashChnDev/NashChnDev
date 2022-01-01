<?php

namespace App\Http\Controllers;

use App\Models\Plants;
use App\Models\DropDowns;
use App\Models\production_lines;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductionLinesFormRequest;
use Exception;
use Yajra\Datatables\Datatables;

class ProductionLinesController extends Controller
{

    /**
     * Display a listing of the production lines.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
		return view('production_lines.index');
    }

	/**
     * Process ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getIndexData()
    {
		$productionLinesObjects = production_lines::with('linedescription','plant')->get();
        
		return Datatables::of($productionLinesObjects)
        ->addColumn('actions', function ($row) {
            
            return '<div class="btn-group btn-group-sm float-right" role="group">
                    <a href="' . route('production_lines.production_lines.show', [$row->id]) . '" class="btn btn-sm btn-outline-primary" title="Show production_lines">
                        <i class="fas fa-fw fa-eye" aria-hidden="true"></i>
                    </a>
                    <a href="' . route('production_lines.production_lines.edit', [$row->id]) . '" class="btn btn-sm btn-outline-primary" title="Edit production_lines">
                        <i class="fas fa-fw fa-edit" aria-hidden="true"></i>
                    </a>
                    <button type="submit" class="btn btn-sm btn-outline-primary btn-delete" title="Delete production_lines" data-remote="' . route('production_lines.production_lines.destroy', [$row->id]) . '" >
                        <i class="fas fa-fw fa-trash-alt" aria-hidden="true"></i>
                    </button>
                </div>'; 
        })
        ->rawColumns(['actions' => 'actions'])
        ->make(true);
    }

	
    /**
     * Show the form for creating a new production lines.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $linedescriptions = DropDowns::pluck('optionvalue','id')->all();
$plants = Plants::pluck('organization','id')->all();
        
        return view('production_lines.create', compact('linedescriptions','plants'));
    }

    /**
     * Store a new production lines in the storage.
     *
     * @param App\Http\Requests\ProductionLinesFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(ProductionLinesFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            production_lines::create($data);

            return redirect()->route('production_lines.production_lines.index')
                             ->with('success_message', 'Production Lines was successfully added!');

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }
    }

    /**
     * Display the specified production lines.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $productionLines = production_lines::with('linedescription','plant')->findOrFail($id);

        return view('production_lines.show', compact('productionLines'));
    }

    /**
     * Show the form for editing the specified production lines.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $productionLines = production_lines::findOrFail($id);
        $linedescriptions = DropDowns::pluck('optionvalue','id')->all();
$plants = Plants::pluck('organization','id')->all();

        return view('production_lines.edit', compact('productionLines','linedescriptions','plants'));
    }

    /**
     * Update the specified production lines in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\ProductionLinesFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, ProductionLinesFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $productionLines = production_lines::findOrFail($id);
            $productionLines->update($data);

            return redirect()->route('production_lines.production_lines.index')
                             ->with('success_message', 'Production Lines was successfully updated!');

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }        
    }

    /**
     * Remove the specified production lines from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $productionLines = production_lines::findOrFail($id);
            $productionLines->delete();

            return redirect()->route('production_lines.production_lines.index')
                             ->with('success_message', 'Production Lines was successfully deleted!');

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }
    }



}
