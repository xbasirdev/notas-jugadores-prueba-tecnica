<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use App\Models\PlayerNote;
use App\Repositories\PlayerNoteRepositoryInterface;
use App\Repositories\UserRepositoryInterface;

class DashboardNotes extends Component
{
    use WithPagination;
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
        $this->players = $usersRepo->players();
        // notes will be loaded in render() to avoid storing paginator in public property
    }

    public function loadNotes($notesRepo = null): void
    {
        // Trigger a refresh by resetting pagination to first page
        $this->resetPage();
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
        $this->resetPage();
    }

    public function render()
    {
        $notesRepo = app(PlayerNoteRepositoryInterface::class);
        $user = Auth::user();

        if ($user && method_exists($user, 'hasPermissionTo') && $user->hasPermissionTo('view all notes')) {
            $notes = $notesRepo->allPaginated(10);
        } elseif ($user && $user->hasRole('admin')) {
            $notes = $notesRepo->allPaginated(10);
        } else {
            $notes = $notesRepo->forPlayerPaginated($user->id, 10);
        }

        return view('livewire.dashboard-notes', [
            'notes' => $notes,
        ]);
    }
}
