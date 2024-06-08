<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReportResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id_num' => $this->id_num,
            'seen' => $this->seen,
            'section_id' => $this->section_id,
            'location' => $this->location,
            'text_1' => $this->text_1,
            'photo_1' => "http://10.0.2.2:8000" . $this->photo_1,
            'report_date' => $this->report_date,
        ];
    }
}
