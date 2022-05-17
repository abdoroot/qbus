<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Email;

class EmailApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_email()
    {
        $email = Email::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/admin/emails', $email
        );

        $this->assertApiResponse($email);
    }

    /**
     * @test
     */
    public function test_read_email()
    {
        $email = Email::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/admin/emails/'.$email->id
        );

        $this->assertApiResponse($email->toArray());
    }

    /**
     * @test
     */
    public function test_update_email()
    {
        $email = Email::factory()->create();
        $editedEmail = Email::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/admin/emails/'.$email->id,
            $editedEmail
        );

        $this->assertApiResponse($editedEmail);
    }

    /**
     * @test
     */
    public function test_delete_email()
    {
        $email = Email::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/admin/emails/'.$email->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/admin/emails/'.$email->id
        );

        $this->response->assertStatus(404);
    }
}
