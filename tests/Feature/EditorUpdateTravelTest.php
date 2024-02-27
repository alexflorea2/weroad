<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Artisan;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class EditorUpdateTravelTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        Artisan::call('app:seed-from-json');
    }

    /** @test */
    public function travel_not_found(): void
    {
        $user = User::where('id', '9442703c-dd4f-13m5-9554-a60574c408be')->first();

        Sanctum::actingAs(
            $user
        );

        $url = '/api/v1/admin/travels/d408be33-aa6a-4c73-a2c8-notexist';

        $response = $this->patchJson($url);

        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }

    /** @test */
    public function request_is_ok(): void
    {
        $user = User::where('id', '9442703c-dd4f-13m5-9554-a60574c408be')->first();

        Sanctum::actingAs(
            $user
        );

        $url = '/api/v1/admin/travels/4f4bd032-e7d4-402a-bdf6-aaf6be240d53';

        $response = $this->patchJson($url, [
            'title' => 'maramures 360',
            'numberOfDays' => 7,
            'description' => 'Lorem ipsum ....',
            'isPublic' => false,
            'moods' => [
                'nature' => 100,
                'relax' => 30,
                'party' => 10,
            ],
        ]);

        $response->assertStatus(Response::HTTP_OK);
        $response->assertJson([
            'data' => [
                'name' => 'maramures 360',
                'slug' => 'maramures-360',
            ],
        ]);

        $this->assertDatabaseHas('travels', [
            'name' => 'maramures 360',
            'isPublic' => false,
        ]);
    }
}
