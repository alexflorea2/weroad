<?php

namespace App\QueryBuilders;

use Illuminate\Database\Eloquent\Builder;

class ToursQueryBuilder extends Builder
{
    final public const SORT_ASCENDING = 'asc';

    final public const SORT_DESCENDING = 'desc';

    public function filterBySlug(string $slug): static
    {
        return $this->whereHas('travel', function ($query) use ($slug) {
            $query->where('slug', $slug);
        });
    }

    public function public($isPublic = true): static
    {
        return $this->whereHas('travel', function ($query) use ($isPublic) {
            $query->where('isPublic', $isPublic);
        });
    }

    public function priceRange($priceFrom = null, $priceTo = null): static
    {
        if (! is_null($priceFrom)) {
            $this->where('price', '>=', $priceFrom * 100);
        }

        if (! is_null($priceTo)) {
            $this->where('price', '<=', $priceTo * 100);
        }

        return $this;
    }

    public function dateRange($dateFrom = null, $dateTo = null): static
    {
        if (! is_null($dateFrom)) {
            $this->where('startingDate', '>=', $dateFrom);
        }

        if (! is_null($dateTo)) {
            $this->where('startingDate', '<=', $dateTo);
        }

        return $this;
    }

    public function sortByPrice(string $direction = self::SORT_ASCENDING): static
    {
        return $this->orderBy('price', $direction);
    }
}
