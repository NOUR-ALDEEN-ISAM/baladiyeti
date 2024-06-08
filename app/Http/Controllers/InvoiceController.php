<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
use App\Http\Trait\MobileResponse;

class InvoiceController extends Controller
{
    use MobileResponse;

    public function store(Request $request)
    {
        $request->validate([
            'id_num' => 'required|integer',
            'invoice_date' => 'required|date',
            'total_amount' => 'required|numeric',
            'status' => 'required|in:مدفوعة,غير مدفوعة,مؤجلة,ملغية',
            'type' => 'required|in:مياه,كهرباء,خدمات البلدية',
        ]);

        $invoice = Invoice::create([
            'id_num' => $request->id_num,
            'invoice_date' => $request->invoice_date,
            'total_amount' => $request->total_amount,
            'status' => $request->status,
            'type' => $request->type,
        ]);

        return $this->success($invoice, 'Invoice created successfully');
    }

    public function update(Request $request, $id)
    {
        $invoice = Invoice::find($id);
        if (!$invoice) {
            return $this->fail("Invoice not found");
        }

        $request->validate([
            'id_num' => 'sometimes|integer',
            'invoice_date' => 'sometimes|date',
            'total_amount' => 'sometimes|numeric',
            'status' => 'sometimes|in:مدفوعة,غير مدفوعة,مؤجلة,ملغية',
            'type' => 'sometimes|in:مياه,كهرباء,خدمات البلدية',
        ]);

        $invoice->update($request->only([
        'id_num',
        'invoice_date',
        'total_amount',
        'status',
        'type'
    ]));

        return $this->success($invoice, 'Invoice updated successfully');
    }

    public function delete($id)
    {
        $invoice = Invoice::find($id);
        if (!$invoice) {
            return $this->fail("Invoice not found");
        }
        
        $invoice->delete();

        return $this->success("Invoice deleted successfully");
    }

    public function show($id)
    {
        $invoice = Invoice::find($id);
        if (!$invoice) {
            return $this->fail("Invoice not found");
        }

        return $this->success($invoice);
    }

    public function index()
    {
        $invoices = Invoice::all();
        return $this->success($invoices);
    }
}

