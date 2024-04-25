<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CateringModel;

class CateringController extends Controller
{
    public function index(Request $request)
    {
        $sortBy = $request->get('sort_by', 'totalPaid');  // Default sort by 'id'
        $sortDirection = $request->get('sort_direction', 'asc');  // Default ascending

        $invoice = CateringModel::orderBy($sortBy, $sortDirection)->paginate(10);  // Paginate for large datasets

        return view('catering.index', compact('catering', 'sortBy', 'sortDirection'));

    }


    public function create()
    {
        return view('catering.create');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        CateringModel::create($request->all());

        return redirect()->route('catering.index')->with('success', 'Receipt added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $invoice = CateringModel::findOrFail($id);

        return view('catering.show', compact('catering'));
    }


//whenever i make progress i keep getting forced to move backwards by ....

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $invoice = CateringModel::findOrFail($id);

        return view('catering.edit', compact('catering'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $catering = CateringModel::findOrFail($id);

        $catering->update($request->all());

        return redirect()->route('catering.index', ['id' => $catering->id])->with('success', 'Invoice updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $catering = CateringModel::findOrFail($id);

        $catering->delete();

        return redirect()->route('catering.index')->with('success', 'Invoice deleted successfully');
    }
}
