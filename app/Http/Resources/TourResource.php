<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TourResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'travelId' => $this->travelId,
            'name' => $this->name,
            'startingDate' => $this->startingDate,
            'endingDate' => $this->endingDate,
            'price' => $this->price,
        ];
    }
}
