<?php

use App\Dto\ToursFilters;
use PHPUnit\Framework\TestCase;

class ToursFiltersDtoTest extends TestCase
{
    /** @test */
    public function it_generates_consistent_cache_key_for_same_parameters()
    {
        $filters1 = (new ToursFilters())
            ->setSlug('example-tour')
            ->setPriceFrom(100)
            ->setPriceTo(500)
            ->setDateFrom('2023-01-01')
            ->setDateTo('2023-12-31')
            ->setSortPrice('asc');

        $filters2 = (new ToursFilters())
            ->setSlug('example-tour')
            ->setPriceFrom(100)
            ->setPriceTo(500)
            ->setDateFrom('2023-01-01')
            ->setDateTo('2023-12-31')
            ->setSortPrice('asc');

        $this->assertEquals($filters1->toCacheKey(), $filters2->toCacheKey());
    }

    /** @test */
    public function it_generates_unique_cache_keys_for_different_parameters()
    {
        $filters1 = (new ToursFilters())
            ->setSlug('example-tour')
            ->setPriceFrom(100)
            ->setPriceTo(500);

        $filters2 = (new ToursFilters())
            ->setSlug('another-tour')
            ->setPriceFrom(150)
            ->setPriceTo(550);

        $this->assertNotEquals($filters1->toCacheKey(), $filters2->toCacheKey());
    }

    /** @test */
    public function it_excludes_null_values_from_cache_key_generation()
    {
        $filtersWithNulls = (new ToursFilters())
            ->setSlug('example-tour')
            ->setPriceFrom(null)
            ->setPriceTo(500);

        $filtersWithoutNulls = (new ToursFilters())
            ->setSlug('example-tour')
            ->setPriceTo(500);

        $this->assertEquals($filtersWithNulls->toCacheKey(), $filtersWithoutNulls->toCacheKey());
    }
}
