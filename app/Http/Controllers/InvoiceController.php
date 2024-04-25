<?php

namespace App\Http\Controllers;

use App\Models\InvoiceModel;
use Illuminate\Http\Request;
use App\Models\Receipt;

class InvoiceController extends Controller
{

    public function index(Request $request)
    {


        $sortBy = $request->get('sort_by', 'totalPaid');  // Default sort by 'id'
        $sortDirection = $request->get('sort_direction', 'asc');  // Default ascending

        $invoice = InvoiceModel::orderBy($sortBy, $sortDirection)->paginate(10);  // Paginate for large datasets

        return view('invoice.index', compact('invoice', 'sortBy', 'sortDirection'));

        //$invoice = InvoiceModel::orderBy('created_at', 'DESC')->get();

        //return view('invoice.index', compact('invoice'));
    }

  //  public function store(Request $request)
  //  {
  //      Validate the incoming request data
  //      $validatedData = $request->validate([
  //          'invoice_number' => 'required|unique:invoices',
  //          'total_amount' => 'required|numeric',
  //      ]);
  //      Create a new Invoice instance with the validated data
  //      $invoice = InvoiceModel::create($validatedData);

  //      Redirect or return a response as needed
  //      return redirect()->route('invoices.show', $invoice->id);
  //  }

    public function create()
    {
        return view('invoice.create');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        InvoiceModel::create($request->all());

        return redirect()->route('invoice.index')->with('success', 'Receipt added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $invoice = InvoiceModel::findOrFail($id);

        return view('invoice.show', compact('invoice'));
    }


//whenever i make progress i keep getting forced to move backwards by ....

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $invoice = InvoiceModel::findOrFail($id);

        return view('invoice.edit', compact('invoice'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $invoice = InvoiceModel::findOrFail($id);

        $invoice->update($request->all());

        return redirect()->route('invoice.index', ['id' => $invoice->id])->with('success', 'Invoice updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $invoice = InvoiceModel::findOrFail($id);

        $invoice->delete();

        return redirect()->route('invoice.index')->with('success', 'Invoice deleted successfully');
    }

    public function pay(string $id)
    {
        $invoice = InvoiceModel::findOrFail($id);

        $invoice->update(['status' => true]);

        $receiptData = [
            'name' => $invoice->name, // Or relevant name for the receipt
            'item' => $invoice->item, // Or a description of the purchase
            'totalPaid' => $invoice->totalPaid,
            'description' => $invoice->description, // Optional: Add invoice description
            'invoice_id' => $invoice->id, // Include invoice ID if using foreign key
            'status' => true,
        ];

        // Create a new receipt record (replace with your logic for saving) //
        $receipt = new Receipt();
        $receipt = Receipt::create($receiptData);

        return redirect()->route('invoice.index', $invoice->id)->with('success', 'Invoice paid successfully');
    }


}


