<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Account;

class AccountApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_account()
    {
        $account = Account::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/admin/accounts', $account
        );

        $this->assertApiResponse($account);
    }

    /**
     * @test
     */
    public function test_read_account()
    {
        $account = Account::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/admin/accounts/'.$account->id
        );

        $this->assertApiResponse($account->toArray());
    }

    /**
     * @test
     */
    public function test_update_account()
    {
        $account = Account::factory()->create();
        $editedAccount = Account::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/admin/accounts/'.$account->id,
            $editedAccount
        );

        $this->assertApiResponse($editedAccount);
    }

    /**
     * @test
     */
    public function test_delete_account()
    {
        $account = Account::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/admin/accounts/'.$account->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/admin/accounts/'.$account->id
        );

        $this->response->assertStatus(404);
    }
}
