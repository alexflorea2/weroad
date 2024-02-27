<?php

namespace App\Services;

use App\Dto\TourFromRequestDto;
use App\Dto\ToursFilters;
use App\Models\Tour;
use App\Models\Travel;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ToursService
{
    public function filterTours(ToursFilters $filters, bool $isPublic = true): LengthAwarePaginator
    {
        return Tour::query()
            ->with('travel', 'travel.moods')
            ->filterBySlug($filters->getSlug())
            ->public($isPublic)
            ->priceRange($filters->getPriceFrom(), $filters->getPriceTo())
            ->dateRange($filters->getDateFrom(), $filters->getDateTo())
            ->sortByPrice($filters->getSortPrice())
            ->paginate();
    }

    public function createTour(TourFromRequestDto $createTourDto): Tour
    {
        if (! Travel::where('id', $createTourDto->getTravelId())->first()) {
            throw new Exception('Travel does not exist, tour cannot be created');
        }

        $tour = new Tour();
        $tour->name = $createTourDto->getTitle();
        $tour->travelId = $createTourDto->getTravelId();
        $tour->startingDate = $createTourDto->getStartingDate();
        $tour->endingDate = $createTourDto->getEndingDate();
        $tour->price = $createTourDto->getPrice();
        $tour->save();

        return $tour;
    }
}
