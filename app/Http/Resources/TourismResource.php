<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TourismResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'location' => $this->location,
            'location_id' => $this->location_id,
            'photo' => "http://10.0.2.2:8000". $this->photo,
            //'photo' =>url( $this->photo),

        ];
    }
}
