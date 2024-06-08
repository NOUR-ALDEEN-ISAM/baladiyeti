<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class InvoiceResource extends JsonResource
{
   
    public function toArray($request)
    {
        return [
            'id_num' => $this->id_num,
            'invoice_date' => $this->invoice_date,
            'total_amount' => $this->total_amount,
            'status' => $this->status,
            'type' => $this->type,
        ];
    }
}
