<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id"=> $this->id,
            "image"=> $this->image,
            "full_name"=> $this->full_name,
            "email"=> $this->email,
            "phone"=> $this->phone,
            "type" => $this->type,
            "age" => $this->age,
            'height'   => $this->height,
            'weight'    => $this->weight,
            'job_title'  => $this->job_title,
            'blood_pressure' => $this->blood_pressure,
            'diabetes'      => $this->diabetes,
            'cholesterol'      => $this->cholesterol,
            'genetic_disease'      => $this->genetic_disease,
            'heart_defects'      => $this->heart_defects,
            'smoking'      => $this->smoking,
            "country"=> $this->country?->name_ar,
        ];
    }
}
