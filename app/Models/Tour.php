<?php

namespace App\Models;

use App\QueryBuilders\ToursQueryBuilder;
use Illuminate\Database\Eloquent\Builder;

class Tour extends UuidModel
{
    /**
     * @method static \App\QueryBuilders\ToursQueryBuilder query()
     */
    public function newEloquentBuilder($query): Builder
    {
        return new ToursQueryBuilder($query);
    }

    public function travel()
    {
        return $this->belongsTo(Travel::class, 'travelId');
    }

    public function getPriceAttribute($value)
    {
        return $value / 100;
    }

    public function setPriceAttribute($value)
    {
        $this->attributes['price'] = $value * 100;
    }

    public function setStartingDateAttribute($value)
    {
        $this->attributes['startingDate'] = $value->toDateString();
    }

    public function setEndingDateAttribute($value)
    {
        $this->attributes['endingDate'] = $value->toDateString();
    }
}
