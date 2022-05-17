<?php namespace Tests\Repositories;

use App\Models\Destination;
use App\Repositories\DestinationRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class DestinationRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var DestinationRepository
     */
    protected $destinationRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->destinationRepo = \App::make(DestinationRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_destination()
    {
        $destination = Destination::factory()->make()->toArray();

        $createdDestination = $this->destinationRepo->create($destination);

        $createdDestination = $createdDestination->toArray();
        $this->assertArrayHasKey('id', $createdDestination);
        $this->assertNotNull($createdDestination['id'], 'Created Destination must have id specified');
        $this->assertNotNull(Destination::find($createdDestination['id']), 'Destination with given id must be in DB');
        $this->assertModelData($destination, $createdDestination);
    }

    /**
     * @test read
     */
    public function test_read_destination()
    {
        $destination = Destination::factory()->create();

        $dbDestination = $this->destinationRepo->find($destination->id);

        $dbDestination = $dbDestination->toArray();
        $this->assertModelData($destination->toArray(), $dbDestination);
    }

    /**
     * @test update
     */
    public function test_update_destination()
    {
        $destination = Destination::factory()->create();
        $fakeDestination = Destination::factory()->make()->toArray();

        $updatedDestination = $this->destinationRepo->update($fakeDestination, $destination->id);

        $this->assertModelData($fakeDestination, $updatedDestination->toArray());
        $dbDestination = $this->destinationRepo->find($destination->id);
        $this->assertModelData($fakeDestination, $dbDestination->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_destination()
    {
        $destination = Destination::factory()->create();

        $resp = $this->destinationRepo->delete($destination->id);

        $this->assertTrue($resp);
        $this->assertNull(Destination::find($destination->id), 'Destination should not exist in DB');
    }
}
