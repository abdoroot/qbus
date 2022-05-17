<?php namespace Tests\Repositories;

use App\Models\Provider;
use App\Repositories\ProviderRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class ProviderRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var ProviderRepository
     */
    protected $providerRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->providerRepo = \App::make(ProviderRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_provider()
    {
        $provider = Provider::factory()->make()->toArray();

        $createdProvider = $this->providerRepo->create($provider);

        $createdProvider = $createdProvider->toArray();
        $this->assertArrayHasKey('id', $createdProvider);
        $this->assertNotNull($createdProvider['id'], 'Created Provider must have id specified');
        $this->assertNotNull(Provider::find($createdProvider['id']), 'Provider with given id must be in DB');
        $this->assertModelData($provider, $createdProvider);
    }

    /**
     * @test read
     */
    public function test_read_provider()
    {
        $provider = Provider::factory()->create();

        $dbProvider = $this->providerRepo->find($provider->id);

        $dbProvider = $dbProvider->toArray();
        $this->assertModelData($provider->toArray(), $dbProvider);
    }

    /**
     * @test update
     */
    public function test_update_provider()
    {
        $provider = Provider::factory()->create();
        $fakeProvider = Provider::factory()->make()->toArray();

        $updatedProvider = $this->providerRepo->update($fakeProvider, $provider->id);

        $this->assertModelData($fakeProvider, $updatedProvider->toArray());
        $dbProvider = $this->providerRepo->find($provider->id);
        $this->assertModelData($fakeProvider, $dbProvider->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_provider()
    {
        $provider = Provider::factory()->create();

        $resp = $this->providerRepo->delete($provider->id);

        $this->assertTrue($resp);
        $this->assertNull(Provider::find($provider->id), 'Provider should not exist in DB');
    }
}
