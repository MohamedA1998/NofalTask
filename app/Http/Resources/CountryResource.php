<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CountryResource extends JsonResource
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
            "name_ar"=> $this->name_ar,
            "name_en"=> $this->name_en,
            'main' => $this->main,
            'code' => $this->code,
            'flag' => $this->flag,
            'status' => $this->status
        ];
    }
}
