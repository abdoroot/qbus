<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Provider;

class ProviderApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_provider()
    {
        $provider = Provider::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/admin/providers', $provider
        );

        $this->assertApiResponse($provider);
    }

    /**
     * @test
     */
    public function test_read_provider()
    {
        $provider = Provider::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/admin/providers/'.$provider->id
        );

        $this->assertApiResponse($provider->toArray());
    }

    /**
     * @test
     */
    public function test_update_provider()
    {
        $provider = Provider::factory()->create();
        $editedProvider = Provider::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/admin/providers/'.$provider->id,
            $editedProvider
        );

        $this->assertApiResponse($editedProvider);
    }

    /**
     * @test
     */
    public function test_delete_provider()
    {
        $provider = Provider::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/admin/providers/'.$provider->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/admin/providers/'.$provider->id
        );

        $this->response->assertStatus(404);
    }
}
