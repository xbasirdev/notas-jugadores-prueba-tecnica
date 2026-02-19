<?php

namespace App\Policies;

use App\Models\User;
use App\Models\PlayerNote;

class PlayerNotePolicy
{
    /**
     * Determine whether the user can create player notes.
     *
     * Customize this method to check roles/permissions (e.g. support agents).
     */
    public function create(User $user): bool
    {
        // Allow users with the permission 'create notes' or admins
        if (method_exists($user, 'hasPermissionTo') && $user->hasPermissionTo('create notes')) {
            return true;
        }

        return $user->hasRole('admin');
    }

    public function view(User $user, PlayerNote $note): bool
    {
        // Admins or users with 'view all notes' can view any note
        if (method_exists($user, 'hasPermissionTo') && $user->hasPermissionTo('view all notes')) {
            return true;
        }

        // The player themselves can view their own notes
        return $user->id === $note->player_id;
    }
}
