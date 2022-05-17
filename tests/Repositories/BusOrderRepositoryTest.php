<?php namespace Tests\Repositories;

use App\Models\BusOrder;
use App\Repositories\BusOrderRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class BusOrderRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var BusOrderRepository
     */
    protected $busOrderRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->busOrderRepo = \App::make(BusOrderRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_bus_order()
    {
        $busOrder = BusOrder::factory()->make()->toArray();

        $createdBusOrder = $this->busOrderRepo->create($busOrder);

        $createdBusOrder = $createdBusOrder->toArray();
        $this->assertArrayHasKey('id', $createdBusOrder);
        $this->assertNotNull($createdBusOrder['id'], 'Created BusOrder must have id specified');
        $this->assertNotNull(BusOrder::find($createdBusOrder['id']), 'BusOrder with given id must be in DB');
        $this->assertModelData($busOrder, $createdBusOrder);
    }

    /**
     * @test read
     */
    public function test_read_bus_order()
    {
        $busOrder = BusOrder::factory()->create();

        $dbBusOrder = $this->busOrderRepo->find($busOrder->id);

        $dbBusOrder = $dbBusOrder->toArray();
        $this->assertModelData($busOrder->toArray(), $dbBusOrder);
    }

    /**
     * @test update
     */
    public function test_update_bus_order()
    {
        $busOrder = BusOrder::factory()->create();
        $fakeBusOrder = BusOrder::factory()->make()->toArray();

        $updatedBusOrder = $this->busOrderRepo->update($fakeBusOrder, $busOrder->id);

        $this->assertModelData($fakeBusOrder, $updatedBusOrder->toArray());
        $dbBusOrder = $this->busOrderRepo->find($busOrder->id);
        $this->assertModelData($fakeBusOrder, $dbBusOrder->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_bus_order()
    {
        $busOrder = BusOrder::factory()->create();

        $resp = $this->busOrderRepo->delete($busOrder->id);

        $this->assertTrue($resp);
        $this->assertNull(BusOrder::find($busOrder->id), 'BusOrder should not exist in DB');
    }
}
