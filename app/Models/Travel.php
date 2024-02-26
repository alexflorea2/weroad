<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Travel extends UuidModel
{
    protected $table = 'travels';

    public function moods()
    {
        return $this->belongsToMany(
            Mood::class,
            'travel_mood',
            'travelId',
            'moodId'
        )
            ->withPivot('weight');
    }
}
