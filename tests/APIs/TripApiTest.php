<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Trip;

class TripApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_trip()
    {
        $trip = Trip::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/admin/trips', $trip
        );

        $this->assertApiResponse($trip);
    }

    /**
     * @test
     */
    public function test_read_trip()
    {
        $trip = Trip::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/admin/trips/'.$trip->id
        );

        $this->assertApiResponse($trip->toArray());
    }

    /**
     * @test
     */
    public function test_update_trip()
    {
        $trip = Trip::factory()->create();
        $editedTrip = Trip::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/admin/trips/'.$trip->id,
            $editedTrip
        );

        $this->assertApiResponse($editedTrip);
    }

    /**
     * @test
     */
    public function test_delete_trip()
    {
        $trip = Trip::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/admin/trips/'.$trip->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/admin/trips/'.$trip->id
        );

        $this->response->assertStatus(404);
    }
}
