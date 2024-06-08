<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ChatResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'seen' => $this->seen,
            'message' => $this->message, 
            'receiver_id' => $this->receiver_id,
        ];
    }
}
