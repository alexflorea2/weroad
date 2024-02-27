<?php

namespace App\Models;

use App\QueryBuilders\ToursQueryBuilder;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Travel
 *
 * @property string $id
 * @property string $travelId
 * @property string $name
 * @property Carbon $startingDate
 * @property Carbon $endingDate
 * @property int $price
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Travel $travel
 */
class Tour extends UuidModel
{
    /**
     * @param  \Illuminate\Database\Query\Builder  $query
     * @return ToursQueryBuilder
     */
    public function newEloquentBuilder($query): Builder
    {
        return new ToursQueryBuilder($query);
    }

    /**
     * @return BelongsTo<Travel, Tour>
     */
    public function travel(): BelongsTo
    {
        return $this->belongsTo(Travel::class, 'travelId');
    }

    public function getPriceAttribute(int $value): float|int
    {
        return $value / 100;
    }

    public function setPriceAttribute(int $value): void
    {
        $this->attributes['price'] = $value * 100;
    }

    public function setStartingDateAttribute(Carbon $value): void
    {
        $this->attributes['startingDate'] = $value->toDateString();
    }

    public function setEndingDateAttribute(Carbon $value): void
    {
        $this->attributes['endingDate'] = $value->toDateString();
    }
}
