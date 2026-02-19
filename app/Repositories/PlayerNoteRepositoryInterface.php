<?php

namespace App\Repositories;

use Illuminate\Support\Collection;
use App\Models\PlayerNote;

interface PlayerNoteRepositoryInterface
{
    public function forPlayer(int $playerId): Collection;

    public function create(array $data): PlayerNote;

    public function all(): Collection;

    public function createForPlayer(int $playerId, int $authorId, string $content): PlayerNote;

    public function forPlayerPaginated(int $playerId, int $perPage = 10);

    public function allPaginated(int $perPage = 10);
}
