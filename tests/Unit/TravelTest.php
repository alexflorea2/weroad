<?php

use App\Models\Tour;
use App\Models\Travel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class TravelTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        Artisan::call('app:seed-from-json');
    }

    /** @test */
    public function it_correctly_generates_slug()
    {
        $travel = new Travel();
        $travel->name = 'jamaica 360';
        $travel->description = 'Lorem ipsum';
        $travel->numberOfDays = 7;

        // trigger any model events or mutators
        $travel->save();

        // Reload the tour from the database to ensure we're getting persisted values
        $persistedTravel = Travel::find($travel->id);

        $this->assertEquals('jamaica-360', $persistedTravel->slug);

        $travel = new Travel();
        $travel->name = 'jamaica 360';
        $travel->description = 'Lorem ipsum';
        $travel->numberOfDays = 7;

        // trigger any model events or mutators
        $travel->save();

        // Reload the tour from the database to ensure we're getting persisted values
        $persistedTravel = Travel::find($travel->id);

        $this->assertEquals('jamaica-360-1', $persistedTravel->slug);
    }
}
