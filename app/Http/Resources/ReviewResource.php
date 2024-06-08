<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReviewResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'tourism_id' => $this->tourism_id,
            'comment' => $this->comment,
            'rate' => $this->rate,
        ];
    }
}
