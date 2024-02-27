<?php


use App\Models\Tour;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class ToursApiTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        Artisan::call('app:seed-from-json');
    }

    /** @test */
    public function test_filter_tours_by_slug_and_price_range(): void
    {
        $slug = 'jordan-360';
        $filters = [
            'price_from' => 1000,
            'price_to' => 2000,
        ];

        $url = "/api/v1/tours/{$slug}?" . http_build_query($filters);

        $response = $this->getJson($url)
            ->assertStatus(Response::HTTP_OK);

        $data = json_decode($response->content(), true);

        $expectedIds = Tour::whereHas('travel', function ($query) use ($slug) {
            $query->where('slug', $slug);
        })->pluck('id')->all();

        $this->assertEqualsCanonicalizing($expectedIds, array_column($data['data'], 'id'));
    }

}
