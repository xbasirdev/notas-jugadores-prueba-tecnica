<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Contracts\Pagination\Paginator;

interface UserRepositoryInterface
{
    public function all(int $perPage = 15): Paginator;

    /**
     * Return collection of users that are players (by role)
     */
    public function players(): \Illuminate\Support\Collection;

    public function find(int $id): ?User;

    public function create(array $data): User;

    public function update(int $id, array $data): bool;

    public function delete(int $id): bool;
}
