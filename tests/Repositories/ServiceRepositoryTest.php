<?php namespace Tests\Repositories;

use App\Models\Service;
use App\Repositories\ServiceRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class ServiceRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var ServiceRepository
     */
    protected $serviceRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->serviceRepo = \App::make(ServiceRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_service()
    {
        $service = Service::factory()->make()->toArray();

        $createdService = $this->serviceRepo->create($service);

        $createdService = $createdService->toArray();
        $this->assertArrayHasKey('id', $createdService);
        $this->assertNotNull($createdService['id'], 'Created Service must have id specified');
        $this->assertNotNull(Service::find($createdService['id']), 'Service with given id must be in DB');
        $this->assertModelData($service, $createdService);
    }

    /**
     * @test read
     */
    public function test_read_service()
    {
        $service = Service::factory()->create();

        $dbService = $this->serviceRepo->find($service->id);

        $dbService = $dbService->toArray();
        $this->assertModelData($service->toArray(), $dbService);
    }

    /**
     * @test update
     */
    public function test_update_service()
    {
        $service = Service::factory()->create();
        $fakeService = Service::factory()->make()->toArray();

        $updatedService = $this->serviceRepo->update($fakeService, $service->id);

        $this->assertModelData($fakeService, $updatedService->toArray());
        $dbService = $this->serviceRepo->find($service->id);
        $this->assertModelData($fakeService, $dbService->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_service()
    {
        $service = Service::factory()->create();

        $resp = $this->serviceRepo->delete($service->id);

        $this->assertTrue($resp);
        $this->assertNull(Service::find($service->id), 'Service should not exist in DB');
    }
}
