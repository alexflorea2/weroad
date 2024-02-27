<?php

namespace App\Services;


use App\Dto\ToursFilters;
use App\Models\Tour;

class ToursService
{
    public function filterTours(ToursFilters $filters)
    {
        return Tour::query()
            ->with('travel', 'travel.moods')
            ->filterBySlug($filters->getSlug())
            ->priceRange($filters->getPriceFrom(), $filters->getPriceTo())
            ->dateRange($filters->getDateFrom(), $filters->getDateTo())
            ->when(!is_null($filters->getSortPrice()), function ($query) use ($filters) {
                return $query->sortByPrice($filters->getSortPrice());
            })
            ->paginate();

    }
}
