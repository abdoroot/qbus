<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Terminal;

class TerminalApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_terminal()
    {
        $terminal = Terminal::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/admin/terminals', $terminal
        );

        $this->assertApiResponse($terminal);
    }

    /**
     * @test
     */
    public function test_read_terminal()
    {
        $terminal = Terminal::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/admin/terminals/'.$terminal->id
        );

        $this->assertApiResponse($terminal->toArray());
    }

    /**
     * @test
     */
    public function test_update_terminal()
    {
        $terminal = Terminal::factory()->create();
        $editedTerminal = Terminal::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/admin/terminals/'.$terminal->id,
            $editedTerminal
        );

        $this->assertApiResponse($editedTerminal);
    }

    /**
     * @test
     */
    public function test_delete_terminal()
    {
        $terminal = Terminal::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/admin/terminals/'.$terminal->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/admin/terminals/'.$terminal->id
        );

        $this->response->assertStatus(404);
    }
}
