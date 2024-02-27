<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

/**
 * Class Travel
 *
 * @property string $id
 * @property string $name
 * @property string $slug
 * @property string $description
 * @property int $numberOfDays
 * @property int $numberOfNights
 * @property bool $isPublic
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Collection|Tour[] $tours
 * @property Collection|Mood[] $moods
 */
class Travel extends UuidModel
{
    protected $table = 'travels';

    protected static function boot(): void
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

    protected static function generateUniqueSlug(string $title): string
    {
        $slug = Str::slug($title);
        $count = static::where('slug', $slug)->count();

        return $count ? "{$slug}-{$count}" : $slug;
    }

    /**
     * @return BelongsToMany<Mood>
     */
    public function moods(): BelongsToMany
    {
        return $this->belongsToMany(
            Mood::class,
            'travel_mood',
            'travelId',
            'moodId'
        )
            ->withPivot('weight');
    }

    /**
     * @return HasMany<Tour>
     */
    public function tours(): HasMany
    {
        return $this->hasMany(Tour::class, 'travelId');
    }

    public function getNumberOfNightsAttribute(): int
    {
        return $this->attributes['numberOfDays'] - 1;
    }
}
