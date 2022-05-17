<?php namespace Tests\Repositories;

use App\Models\Bus;
use App\Repositories\BusRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class BusRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var BusRepository
     */
    protected $busRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->busRepo = \App::make(BusRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_bus()
    {
        $bus = Bus::factory()->make()->toArray();

        $createdBus = $this->busRepo->create($bus);

        $createdBus = $createdBus->toArray();
        $this->assertArrayHasKey('id', $createdBus);
        $this->assertNotNull($createdBus['id'], 'Created Bus must have id specified');
        $this->assertNotNull(Bus::find($createdBus['id']), 'Bus with given id must be in DB');
        $this->assertModelData($bus, $createdBus);
    }

    /**
     * @test read
     */
    public function test_read_bus()
    {
        $bus = Bus::factory()->create();

        $dbBus = $this->busRepo->find($bus->id);

        $dbBus = $dbBus->toArray();
        $this->assertModelData($bus->toArray(), $dbBus);
    }

    /**
     * @test update
     */
    public function test_update_bus()
    {
        $bus = Bus::factory()->create();
        $fakeBus = Bus::factory()->make()->toArray();

        $updatedBus = $this->busRepo->update($fakeBus, $bus->id);

        $this->assertModelData($fakeBus, $updatedBus->toArray());
        $dbBus = $this->busRepo->find($bus->id);
        $this->assertModelData($fakeBus, $dbBus->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_bus()
    {
        $bus = Bus::factory()->create();

        $resp = $this->busRepo->delete($bus->id);

        $this->assertTrue($resp);
        $this->assertNull(Bus::find($bus->id), 'Bus should not exist in DB');
    }
}
