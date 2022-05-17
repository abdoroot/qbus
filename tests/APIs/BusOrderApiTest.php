<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\BusOrder;

class BusOrderApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_bus_order()
    {
        $busOrder = BusOrder::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/admin/bus_orders', $busOrder
        );

        $this->assertApiResponse($busOrder);
    }

    /**
     * @test
     */
    public function test_read_bus_order()
    {
        $busOrder = BusOrder::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/admin/bus_orders/'.$busOrder->id
        );

        $this->assertApiResponse($busOrder->toArray());
    }

    /**
     * @test
     */
    public function test_update_bus_order()
    {
        $busOrder = BusOrder::factory()->create();
        $editedBusOrder = BusOrder::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/admin/bus_orders/'.$busOrder->id,
            $editedBusOrder
        );

        $this->assertApiResponse($editedBusOrder);
    }

    /**
     * @test
     */
    public function test_delete_bus_order()
    {
        $busOrder = BusOrder::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/admin/bus_orders/'.$busOrder->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/admin/bus_orders/'.$busOrder->id
        );

        $this->response->assertStatus(404);
    }
}
