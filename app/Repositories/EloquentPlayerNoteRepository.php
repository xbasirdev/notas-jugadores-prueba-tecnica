<?php

namespace App\Repositories;

use App\Models\PlayerNote;
use Illuminate\Support\Collection;

class EloquentPlayerNoteRepository implements PlayerNoteRepositoryInterface
{
    public function forPlayer(int $playerId): Collection
    {
        return PlayerNote::with('author')
            ->where('player_id', $playerId)
            ->orderByDesc('created_at')
            ->get();
    }

    public function all(): Collection
    {
        return PlayerNote::with(['author','player'])
            ->orderByDesc('created_at')
            ->get();
    }

    public function create(array $data): PlayerNote
    {
        return PlayerNote::create($data);
    }

    public function createForPlayer(int $playerId, int $authorId, string $content): PlayerNote
    {
        return PlayerNote::create([
            'player_id' => $playerId,
            'author_id' => $authorId,
            'content' => $content,
        ]);
    }
}
