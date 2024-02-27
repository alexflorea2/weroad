<?php

namespace Tests\Feature;

use App\Models\Tour;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class ToursQueryBuilderTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        Artisan::call('app:seed-from-json');
    }

    /** @test */
    public function is_has_tour_by_slug()
    {
        $queryBuilder = Tour::query();
        $filteredTours = $queryBuilder->filterBySlug('jordan-360')->get();

        $this->assertNotEmpty($filteredTours);
        $this->assertContains($filteredTours->first()->id, [
            '0be966b8-0a9b-4220-b9b2-e49d2cc0c2ab',
            '2a0edc99-c9fe-4206-8da5-413586667a21',
            '7f0ff8cc-6b19-407e-9915-279ad76c0b5c',
        ]);
    }

    /** @test */
    public function is_does_not_have_tour_by_slug()
    {
        $queryBuilder = Tour::query();
        $filteredTours = $queryBuilder->filterBySlug('jordan-361')->get();

        $this->assertEmpty($filteredTours);
    }

    /** @test */
    public function is_in_price_range()
    {
        $queryBuilder = Tour::query();
        $filteredTours = $queryBuilder->priceRange(1999, 2149)->get();

        $this->assertCount(3, $filteredTours);
    }

    /** @test */
    public function is_in_date_range()
    {
        $queryBuilder = Tour::query();
        $filteredTours = $queryBuilder->dateRange('2021-11-20', '2022-01-10')->get();

        $this->assertCount(3, $filteredTours);
    }
}
