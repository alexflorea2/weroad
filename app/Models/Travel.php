<?php

namespace App\Models;

use Illuminate\Support\Str;

class Travel extends UuidModel
{
    protected $table = 'travels';

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->slug)) {
                $model->slug = static::generateUniqueSlug($model->name);
            }
        });

        static::updating(function ($model) {
            if ($model->isDirty('name')) {
                $model->slug = static::generateUniqueSlug($model->name);
            }
        });
    }

    protected static function generateUniqueSlug($title)
    {
        $slug = Str::slug($title);
        $count = static::where('slug', $slug)->count();

        return $count ? "{$slug}-{$count}" : $slug;
    }

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

    public function tours()
    {
        return $this->hasMany(Tour::class, 'travelId');
    }

    public function getNumberOfNightsAttribute(): int
    {
        return $this->attributes['numberOfDays'] - 1;
    }
}
