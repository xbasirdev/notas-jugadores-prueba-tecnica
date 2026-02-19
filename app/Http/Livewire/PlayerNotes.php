<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\PlayerNote;
use App\Repositories\PlayerNoteRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class PlayerNotes extends Component
{
    public User $player;
    public string $content = '';

    protected array $rules = [
        'content' => 'required|string|max:1000',
    ];

    public function mount(User $player): void
    {
        $this->player = $player;
    }

    public function addNote(): void
    {
        $this->validate();

        if (! Auth::check() || ! Auth::user()->can('create', PlayerNote::class)) {
            abort(403);
        }
        $repo = app(PlayerNoteRepositoryInterface::class);
        $repo->createForPlayer($this->player->id, Auth::id(), $this->content);

        $this->reset('content');
        $this->dispatch('noteAdded');
    }

    public function render()
    {
        $notes = app(PlayerNoteRepositoryInterface::class)->forPlayer($this->player->id);

        return view('livewire.player-notes', [
            'notes' => $notes,
        ]);
    }
}
