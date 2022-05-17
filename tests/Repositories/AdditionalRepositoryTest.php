<?php namespace Tests\Repositories;

use App\Models\Additional;
use App\Repositories\AdditionalRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class AdditionalRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var AdditionalRepository
     */
    protected $additionalRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->additionalRepo = \App::make(AdditionalRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_additional()
    {
        $additional = Additional::factory()->make()->toArray();

        $createdAdditional = $this->additionalRepo->create($additional);

        $createdAdditional = $createdAdditional->toArray();
        $this->assertArrayHasKey('id', $createdAdditional);
        $this->assertNotNull($createdAdditional['id'], 'Created Additional must have id specified');
        $this->assertNotNull(Additional::find($createdAdditional['id']), 'Additional with given id must be in DB');
        $this->assertModelData($additional, $createdAdditional);
    }

    /**
     * @test read
     */
    public function test_read_additional()
    {
        $additional = Additional::factory()->create();

        $dbAdditional = $this->additionalRepo->find($additional->id);

        $dbAdditional = $dbAdditional->toArray();
        $this->assertModelData($additional->toArray(), $dbAdditional);
    }

    /**
     * @test update
     */
    public function test_update_additional()
    {
        $additional = Additional::factory()->create();
        $fakeAdditional = Additional::factory()->make()->toArray();

        $updatedAdditional = $this->additionalRepo->update($fakeAdditional, $additional->id);

        $this->assertModelData($fakeAdditional, $updatedAdditional->toArray());
        $dbAdditional = $this->additionalRepo->find($additional->id);
        $this->assertModelData($fakeAdditional, $dbAdditional->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_additional()
    {
        $additional = Additional::factory()->create();

        $resp = $this->additionalRepo->delete($additional->id);

        $this->assertTrue($resp);
        $this->assertNull(Additional::find($additional->id), 'Additional should not exist in DB');
    }
}
