<?php

namespace App\Services;


use App\Dto\TravelFromRequestDto;
use App\Dto\ToursFilters;
use App\Models\Mood;
use App\Models\Tour;
use App\Models\Travel;

class TravelService
{
    /**
     * @throws \Exception
     */
    public function createTravel(TravelFromRequestDto $createTravelDto)
    {
        if(Travel::where('name',$createTravelDto->getTitle())->first()) {
            throw new \Exception('Travel exists');
        }

        $travel = new Travel();
        $travel->name = $createTravelDto->getTitle();
        $travel->description = $createTravelDto->getDescription();
        $travel->numberOfDays = $createTravelDto->getNumberOfDays();
        $travel->save();

        foreach ($createTravelDto->getMoods() as $moodName => $weight) {
            $mood = Mood::where(['name' => $moodName])->first();
            if(!$mood) {
                $mood = new Mood();
                $mood->name = $moodName;
                $mood->save();
            }
            $travel->moods()->syncWithoutDetaching([(string)$mood->id => ['weight' => $weight]]);
        }

        return $travel;
    }

    /**
     * @throws \Exception
     */
    public function updateTravel(Travel $travel, TravelFromRequestDto $createTravelDto)
    {
        $travel->name = $createTravelDto->getTitle();
        $travel->description = $createTravelDto->getDescription();
        $travel->numberOfDays = $createTravelDto->getNumberOfDays();
        $travel->save();

        $moodData = [];
        foreach ($createTravelDto->getMoods() as $moodName => $weight) {
            $mood = Mood::firstOrCreate(['name' => $moodName]);
            $moodData[$mood->id] = ['weight' => $weight];
        }

        $travel->moods()->sync($moodData);

        return $travel;
    }
}
