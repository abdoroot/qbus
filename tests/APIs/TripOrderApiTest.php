<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\TripOrder;

class TripOrderApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_trip_order()
    {
        $tripOrder = TripOrder::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/admin/trip_orders', $tripOrder
        );

        $this->assertApiResponse($tripOrder);
    }

    /**
     * @test
     */
    public function test_read_trip_order()
    {
        $tripOrder = TripOrder::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/admin/trip_orders/'.$tripOrder->id
        );

        $this->assertApiResponse($tripOrder->toArray());
    }

    /**
     * @test
     */
    public function test_update_trip_order()
    {
        $tripOrder = TripOrder::factory()->create();
        $editedTripOrder = TripOrder::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/admin/trip_orders/'.$tripOrder->id,
            $editedTripOrder
        );

        $this->assertApiResponse($editedTripOrder);
    }

    /**
     * @test
     */
    public function test_delete_trip_order()
    {
        $tripOrder = TripOrder::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/admin/trip_orders/'.$tripOrder->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/admin/trip_orders/'.$tripOrder->id
        );

        $this->response->assertStatus(404);
    }
}
