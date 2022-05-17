<?php namespace Tests\Repositories;

use App\Models\TripOrder;
use App\Repositories\TripOrderRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class TripOrderRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var TripOrderRepository
     */
    protected $tripOrderRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->tripOrderRepo = \App::make(TripOrderRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_trip_order()
    {
        $tripOrder = TripOrder::factory()->make()->toArray();

        $createdTripOrder = $this->tripOrderRepo->create($tripOrder);

        $createdTripOrder = $createdTripOrder->toArray();
        $this->assertArrayHasKey('id', $createdTripOrder);
        $this->assertNotNull($createdTripOrder['id'], 'Created TripOrder must have id specified');
        $this->assertNotNull(TripOrder::find($createdTripOrder['id']), 'TripOrder with given id must be in DB');
        $this->assertModelData($tripOrder, $createdTripOrder);
    }

    /**
     * @test read
     */
    public function test_read_trip_order()
    {
        $tripOrder = TripOrder::factory()->create();

        $dbTripOrder = $this->tripOrderRepo->find($tripOrder->id);

        $dbTripOrder = $dbTripOrder->toArray();
        $this->assertModelData($tripOrder->toArray(), $dbTripOrder);
    }

    /**
     * @test update
     */
    public function test_update_trip_order()
    {
        $tripOrder = TripOrder::factory()->create();
        $fakeTripOrder = TripOrder::factory()->make()->toArray();

        $updatedTripOrder = $this->tripOrderRepo->update($fakeTripOrder, $tripOrder->id);

        $this->assertModelData($fakeTripOrder, $updatedTripOrder->toArray());
        $dbTripOrder = $this->tripOrderRepo->find($tripOrder->id);
        $this->assertModelData($fakeTripOrder, $dbTripOrder->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_trip_order()
    {
        $tripOrder = TripOrder::factory()->create();

        $resp = $this->tripOrderRepo->delete($tripOrder->id);

        $this->assertTrue($resp);
        $this->assertNull(TripOrder::find($tripOrder->id), 'TripOrder should not exist in DB');
    }
}
