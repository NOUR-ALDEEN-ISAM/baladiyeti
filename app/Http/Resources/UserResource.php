<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'phone' => $this->phone,
            'type' => $this->type,
            'address' => $this->address,
            'id_num' => $this->id_num,
            //'photo' =>url( $this->photo),
            'photo' => "http://10.0.2.2:8000". $this->photo,
        ];
    }
}
