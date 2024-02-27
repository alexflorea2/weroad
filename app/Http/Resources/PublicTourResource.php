<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PublicTourResource extends JsonResource
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
            'travel' => $this->whenLoaded('travel', function () {
                $travelArray = [
                    'name' => $this->travel->name,
                    'description' => $this->travel->description,
                    'numberOfDays' => $this->travel->numberOfDays,
                ];

                if ($this->travel->relationLoaded('moods')) {
                    $travelArray['moods'] = $this->travel->moods->map(function ($mood) {
                        return [
                            'name' => $mood->name,
                            'weight' => $mood->pivot->weight,
                        ];
                    })->all(); // Convert the collection to an array
                }

                return $travelArray;
            }),
        ];
    }
}
