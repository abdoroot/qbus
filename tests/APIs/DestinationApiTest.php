<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Destination;

class DestinationApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_destination()
    {
        $destination = Destination::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/admin/destinations', $destination
        );

        $this->assertApiResponse($destination);
    }

    /**
     * @test
     */
    public function test_read_destination()
    {
        $destination = Destination::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/admin/destinations/'.$destination->id
        );

        $this->assertApiResponse($destination->toArray());
    }

    /**
     * @test
     */
    public function test_update_destination()
    {
        $destination = Destination::factory()->create();
        $editedDestination = Destination::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/admin/destinations/'.$destination->id,
            $editedDestination
        );

        $this->assertApiResponse($editedDestination);
    }

    /**
     * @test
     */
    public function test_delete_destination()
    {
        $destination = Destination::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/admin/destinations/'.$destination->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/admin/destinations/'.$destination->id
        );

        $this->response->assertStatus(404);
    }
}
