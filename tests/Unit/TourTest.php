<?php

namespace Tests\Unit;

use App\Models\Tour;
use App\Models\Travel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class TourTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        Artisan::call('app:seed-from-json');
    }

    /** @test */
    public function it_correctly_handles_price_conversion()
    {
        $tour = new Tour();
        $tour->price = 699;
        $tour->travelId = Travel::query()->first()->id;
        $tour->name = "test price";
        $tour->startingDate = new \DateTime();
        $tour->endingDate = new \DateTime();

        // trigger any model events or mutators
        $tour->save();

        // Reload the tour from the database to ensure we're getting persisted values
        $persistedTour = Tour::find($tour->id);

        $this->assertEquals(69900, $persistedTour->getAttributes()['price']);

        $this->assertEquals(699, $persistedTour->price);
    }
}
