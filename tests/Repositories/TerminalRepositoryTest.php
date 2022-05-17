<?php namespace Tests\Repositories;

use App\Models\Terminal;
use App\Repositories\TerminalRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class TerminalRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var TerminalRepository
     */
    protected $terminalRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->terminalRepo = \App::make(TerminalRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_terminal()
    {
        $terminal = Terminal::factory()->make()->toArray();

        $createdTerminal = $this->terminalRepo->create($terminal);

        $createdTerminal = $createdTerminal->toArray();
        $this->assertArrayHasKey('id', $createdTerminal);
        $this->assertNotNull($createdTerminal['id'], 'Created Terminal must have id specified');
        $this->assertNotNull(Terminal::find($createdTerminal['id']), 'Terminal with given id must be in DB');
        $this->assertModelData($terminal, $createdTerminal);
    }

    /**
     * @test read
     */
    public function test_read_terminal()
    {
        $terminal = Terminal::factory()->create();

        $dbTerminal = $this->terminalRepo->find($terminal->id);

        $dbTerminal = $dbTerminal->toArray();
        $this->assertModelData($terminal->toArray(), $dbTerminal);
    }

    /**
     * @test update
     */
    public function test_update_terminal()
    {
        $terminal = Terminal::factory()->create();
        $fakeTerminal = Terminal::factory()->make()->toArray();

        $updatedTerminal = $this->terminalRepo->update($fakeTerminal, $terminal->id);

        $this->assertModelData($fakeTerminal, $updatedTerminal->toArray());
        $dbTerminal = $this->terminalRepo->find($terminal->id);
        $this->assertModelData($fakeTerminal, $dbTerminal->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_terminal()
    {
        $terminal = Terminal::factory()->create();

        $resp = $this->terminalRepo->delete($terminal->id);

        $this->assertTrue($resp);
        $this->assertNull(Terminal::find($terminal->id), 'Terminal should not exist in DB');
    }
}
