<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class InvoiceController extends Controller
{
    public function index(Request $request)
    {
        $id_num = $request->input('id_num');
        $invoices = Invoice::when($id_num, function ($query, $id_num) {
            return $query->where('id_num', $id_num);
        })->get();

        return view('invoices.index', compact('invoices'));
    }

    public function create()
    {
        return view('invoices.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_num' => 'required|string|max:255',
            'invoice_date' => 'required|date',
            'total_amount' => 'required|numeric',
            'status' => 'required|string|max:255',
            'type' => 'required|string|max:255',
        ]);

        Invoice::create($request->all());

        return redirect()->route('invoices.index')->with('success', 'Invoice created successfully.');
    }

    public function destroy($id)
    {
        $invoice = Invoice::find($id);

        if (!$invoice) {
            Log::error("Invoice with ID $id not found.");
            return redirect()->back()->with('error', "Invoice with ID $id not found.");
        }

        $invoice->delete();
        Log::info("Invoice with ID $id deleted successfully.");

        return redirect()->back()->with('success', 'Invoice deleted successfully.');
    }
}
