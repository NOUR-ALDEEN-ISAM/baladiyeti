<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class InformationResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'seen' => $this->seen,
            'message' => $this->message,
            'response' => $this->response,
            'employee' => $this->employee,
        ];
    }
}
