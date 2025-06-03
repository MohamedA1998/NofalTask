<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FollowerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "image"=> $this->image,
            'height'   => $this->height,
            'weight'    => $this->weight,
            'job_title'  => $this->job_title,
            'blood_pressure' => $this->blood_pressure,
            'diabetes'      => $this->diabetes,
            'cholesterol'      => $this->cholesterol,
            'genetic_disease'      => $this->genetic_disease,
            'heart_defects'      => $this->heart_defects,
            'smoking'      => $this->smoking,
        ];
    }
}
