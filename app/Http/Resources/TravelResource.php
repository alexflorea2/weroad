<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TravelResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        $travelArray = [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description,
            'numberOfDays' => $this->numberOfDays,
            'numberOfNights' => $this->numberOfNights,
        ];

        if ($this->relationLoaded('moods')) {
            $travelArray['moods'] = $this->moods->map(function ($mood) {
                return [
                    'name' => $mood->name,
                    'weight' => $mood->pivot->weight,
                ];
            })->all(); // Convert the collection to an array
        }

        return $travelArray;
    }
}
