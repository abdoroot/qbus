<?php namespace Tests\Repositories;

use App\Models\Email;
use App\Repositories\EmailRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class EmailRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var EmailRepository
     */
    protected $emailRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->emailRepo = \App::make(EmailRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_email()
    {
        $email = Email::factory()->make()->toArray();

        $createdEmail = $this->emailRepo->create($email);

        $createdEmail = $createdEmail->toArray();
        $this->assertArrayHasKey('id', $createdEmail);
        $this->assertNotNull($createdEmail['id'], 'Created Email must have id specified');
        $this->assertNotNull(Email::find($createdEmail['id']), 'Email with given id must be in DB');
        $this->assertModelData($email, $createdEmail);
    }

    /**
     * @test read
     */
    public function test_read_email()
    {
        $email = Email::factory()->create();

        $dbEmail = $this->emailRepo->find($email->id);

        $dbEmail = $dbEmail->toArray();
        $this->assertModelData($email->toArray(), $dbEmail);
    }

    /**
     * @test update
     */
    public function test_update_email()
    {
        $email = Email::factory()->create();
        $fakeEmail = Email::factory()->make()->toArray();

        $updatedEmail = $this->emailRepo->update($fakeEmail, $email->id);

        $this->assertModelData($fakeEmail, $updatedEmail->toArray());
        $dbEmail = $this->emailRepo->find($email->id);
        $this->assertModelData($fakeEmail, $dbEmail->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_email()
    {
        $email = Email::factory()->create();

        $resp = $this->emailRepo->delete($email->id);

        $this->assertTrue($resp);
        $this->assertNull(Email::find($email->id), 'Email should not exist in DB');
    }
}
