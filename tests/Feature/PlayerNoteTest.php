<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\PlayerNote;
use Livewire\Livewire;
use Spatie\Permission\Models\Permission;
use App\Http\Livewire\DashboardNotes;

class PlayerNoteTest extends TestCase
{
    use RefreshDatabase;

    public function test_author_can_create_note_and_it_is_saved_in_database(): void
    {
        // prepare permissions used by views/policies
        Permission::firstOrCreate(['name' => 'create notes']);
        Permission::firstOrCreate(['name' => 'view all notes']);

        $author = User::factory()->create();
        $author->givePermissionTo('create notes');

        $player = User::factory()->create();

        $this->actingAs($author);

        $content = 'This is a test note from author.';

        // Call Livewire component directly
        Livewire::test(DashboardNotes::class)
            ->set('player_id', $player->id)
            ->set('content', $content)
            ->call('addNote')
            ->assertHasNoErrors();

        $this->assertDatabaseHas('player_notes', [
            'player_id' => $player->id,
            'author_id' => $author->id,
            'content' => $content,
        ]);
    }
}
