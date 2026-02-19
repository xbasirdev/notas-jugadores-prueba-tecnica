<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\PlayerNote;
use App\Repositories\PlayerNoteRepositoryInterface;
use App\Repositories\UserRepositoryInterface;

class DashboardNotes extends Component
{
    public $notes;
    public $players;
    public $player_id;
    public string $content = '';
    protected $listeners = ['noteAdded' => 'loadNotes'];

    protected array $rules = [
        'content' => 'required|string|max:200',
        'player_id' => 'required|integer',
    ];

    public function mount()
    {
        $usersRepo = app(UserRepositoryInterface::class);
        $notesRepo = app(PlayerNoteRepositoryInterface::class);

        $this->players = $usersRepo->players();
        $this->loadNotes($notesRepo);
    }

    public function loadNotes($notesRepo = null): void
    {
        $notesRepo = $notesRepo ?? app(PlayerNoteRepositoryInterface::class);
        $user = Auth::user();

        if ($user && method_exists($user, 'hasPermissionTo') && $user->hasPermissionTo('view all notes')) {
            $this->notes = $notesRepo->all();
        } elseif ($user && $user->hasRole('admin')) {
            $this->notes = $notesRepo->all();
        } else {
            // player sees only own notes
            $this->notes = $notesRepo->forPlayer($user->id);
        }
    }

    public function addNote(): void
    {
        $this->validate();

        $user = Auth::user();
        if (! $user || ! $user->can('create', PlayerNote::class)) {
            $this->addError('permission', 'Not authorized to add notes.');
            return;
        }

        $notesRepo = app(PlayerNoteRepositoryInterface::class);
        $notesRepo->createForPlayer((int) $this->player_id, $user->id, $this->content);

        $this->reset(['content','player_id']);
        $this->dispatch('noteAdded');
    }

    public function render()
    {
        return view('livewire.dashboard-notes');
    }
}
