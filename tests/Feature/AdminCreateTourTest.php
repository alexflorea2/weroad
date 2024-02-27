<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Artisan;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class AdminCreateTourTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        Artisan::call('app:seed-from-json');
    }

    /** @test */
    public function editor_does_not_have_access(): void
    {
        $user = User::where('id', '9442703c-dd4f-13m5-9554-a60574c408be')->first();

        Sanctum::actingAs(
            $user
        );

        $url = '/api/v1/admin/tours';

        $response = $this->postJson($url)
            ->assertStatus(Response::HTTP_FORBIDDEN);
    }

    /** @test */
    public function request_is_not_ok(): void
    {
        $user = User::where('id', 'baf18948-721e-90i8-aa7f-bed1a5415cb6')->first();

        Sanctum::actingAs(
            $user
        );

        $url = '/api/v1/admin/tours';

        $response = $this->postJson($url, [
            'travelId' => '4f4bd032-e7d4-402a-bdf6-aaf6be240d53',
            'price' => 6969,
            'startingDate' => '2024-03-12',
            'endingDate' => '2024-03-27',
        ]);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJsonValidationErrors([
            'title' => 'The title field is required.',
        ]);
    }

    /** @test */
    public function request_is_ok(): void
    {
        $user = User::where('id', 'baf18948-721e-90i8-aa7f-bed1a5415cb6')->first();

        Sanctum::actingAs(
            $user
        );

        $url = '/api/v1/admin/tours';

        $response = $this->postJson($url, [
            'title' => 'maramures 360 tour',
            'travelId' => '4f4bd032-e7d4-402a-bdf6-aaf6be240d53',
            'price' => 6969,
            'startingDate' => '2024-03-12',
            'endingDate' => '2024-03-27',
        ]);

        $response->assertStatus(Response::HTTP_CREATED);
        $response->assertJson([
            'data' => [
                'name' => 'maramures 360 tour',
                'travelId' => '4f4bd032-e7d4-402a-bdf6-aaf6be240d53',
                'price' => 6969,
            ],
        ]);
    }
}
