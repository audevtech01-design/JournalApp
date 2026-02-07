<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\JournalEntry;
use Tests\TestCase;

class JournalEntryTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_can_create_journal_entry() 
    {
        $response = $this->post('/store', [
            'title', 'Test Entry',
            'content', 'This is a test journal entry',
        ]);

        $response->assertRedirect('/');

        $this->assertDatabaseHas('journal_entries', [
            'title', 'Test Entry',
        ]);
    }

    public function test_can_view_journal_entry() 
    {
        $entry = JournalEntry::factory()->create();
        $response = $this->get('/');
        $response = $this->assertSee($entry->title);
    }

    public function test_can_delete_journal_entry() 
    {
        $entry = JournalEntry::factory()->create();
        $response = $this->delete("/enrty/{$entry->id}");
        $this->assertDatabaseMissing('journal_entries', [
            'id' => $entry->id,
        ]);
    }
}
