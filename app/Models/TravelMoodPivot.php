<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Support\Str;

class TravelMoodPivot extends Pivot
{
    public $incrementing = false;

    protected $keyType = 'string';

    public static function booted()
    {
        static::creating(function ($model) {
            $model->setAttribute($model->getKeyName(), Str::orderedUuid());
        });
    }
}
