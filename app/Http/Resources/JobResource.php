<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class JobResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'skills' => $this->skills,
            'status' => $this->status,
            'section_id' => $this->section_id,
            'user_id' => $this->user_id,

        ];
    }
}
