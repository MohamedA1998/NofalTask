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
        $data = [
            "id"=> $this->id,
            "full_name"=> $this->full_name,
            "email"=> $this->email,
            "phone"=> $this->phone,
            "type" => $this->type,
            "age" => $this->age,
            "country"=> $this->country?->name_ar,
        ];

        if($this->type === 'follower') {
            $data['follower'] = new FollowerResource($this->whenLoaded('follower'));
        }

        return $data;
    }
}
