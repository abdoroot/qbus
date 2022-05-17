<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Additional;

class AdditionalApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_additional()
    {
        $additional = Additional::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/admin/additionals', $additional
        );

        $this->assertApiResponse($additional);
    }

    /**
     * @test
     */
    public function test_read_additional()
    {
        $additional = Additional::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/admin/additionals/'.$additional->id
        );

        $this->assertApiResponse($additional->toArray());
    }

    /**
     * @test
     */
    public function test_update_additional()
    {
        $additional = Additional::factory()->create();
        $editedAdditional = Additional::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/admin/additionals/'.$additional->id,
            $editedAdditional
        );

        $this->assertApiResponse($editedAdditional);
    }

    /**
     * @test
     */
    public function test_delete_additional()
    {
        $additional = Additional::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/admin/additionals/'.$additional->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/admin/additionals/'.$additional->id
        );

        $this->response->assertStatus(404);
    }
}
