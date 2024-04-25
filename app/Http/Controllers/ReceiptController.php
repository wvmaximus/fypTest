<?php

namespace App\Http\Controllers;

use App\Models\Receipt;
use Illuminate\Http\Request;


class ReceiptController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $receipt = Receipt::orderBy('created_at', 'DESC')->get();

        return view('receipt.index', compact('receipt'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('receipt.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Receipt::create($request->all());

        return redirect()->route('receipt.index')->with('success', 'Receipt added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $receipt = Receipt::findOrFail($id);

        return view('receipt.show', compact('receipt'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $receipt = Receipt::findOrFail($id);

        return view('receipt.edit', compact('receipt'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $receipt = Receipt::findOrFail($id);

        $receipt->update($request->all());

        return redirect()->route('receipt.index', ['id' => $receipt->id])->with('success', 'Receipt updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $receipt = Receipt::findOrFail($id);

        $receipt->delete();

        return redirect()->route('receipt.index')->with('success', 'Receipt deleted successfully');
    }
}
