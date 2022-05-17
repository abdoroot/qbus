<?php namespace Tests\Repositories;

use App\Models\Trip;
use App\Repositories\TripRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class TripRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var TripRepository
     */
    protected $tripRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->tripRepo = \App::make(TripRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_trip()
    {
        $trip = Trip::factory()->make()->toArray();

        $createdTrip = $this->tripRepo->create($trip);

        $createdTrip = $createdTrip->toArray();
        $this->assertArrayHasKey('id', $createdTrip);
        $this->assertNotNull($createdTrip['id'], 'Created Trip must have id specified');
        $this->assertNotNull(Trip::find($createdTrip['id']), 'Trip with given id must be in DB');
        $this->assertModelData($trip, $createdTrip);
    }

    /**
     * @test read
     */
    public function test_read_trip()
    {
        $trip = Trip::factory()->create();

        $dbTrip = $this->tripRepo->find($trip->id);

        $dbTrip = $dbTrip->toArray();
        $this->assertModelData($trip->toArray(), $dbTrip);
    }

    /**
     * @test update
     */
    public function test_update_trip()
    {
        $trip = Trip::factory()->create();
        $fakeTrip = Trip::factory()->make()->toArray();

        $updatedTrip = $this->tripRepo->update($fakeTrip, $trip->id);

        $this->assertModelData($fakeTrip, $updatedTrip->toArray());
        $dbTrip = $this->tripRepo->find($trip->id);
        $this->assertModelData($fakeTrip, $dbTrip->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_trip()
    {
        $trip = Trip::factory()->create();

        $resp = $this->tripRepo->delete($trip->id);

        $this->assertTrue($resp);
        $this->assertNull(Trip::find($trip->id), 'Trip should not exist in DB');
    }
}
