<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;

class EloquentUserRepository implements UserRepositoryInterface
{
    public function all(int $perPage = 15): Paginator
    {
        return User::paginate($perPage);
    }

    public function find(int $id): ?User
    {
        return User::find($id);
    }

    public function create(array $data): User
    {
        $payload = Arr::only($data, ['name','email','password','active']);
        if (! empty($payload['password'])) {
            $payload['password'] = Hash::make($payload['password']);
        }

        $user = User::create($payload);

        if (! empty($data['roles'])) {
            $user->assignRole($data['roles']);
        }

        return $user;
    }

    public function update(int $id, array $data): bool
    {
        $user = $this->find($id);
        if (! $user) {
            return false;
        }

        $user->fill(Arr::only($data, ['name','email','active']));
        if (! empty($data['password'])) {
            $user->password = Hash::make($data['password']);
        }

        $saved = $user->save();

        if (! empty($data['roles'])) {
            $user->syncRoles($data['roles']);
        }

        return $saved;
    }

    public function delete(int $id): bool
    {
        $user = $this->find($id);
        if (! $user) {
            return false;
        }

        return (bool) $user->delete();
    }

    public function players(): \Illuminate\Support\Collection
    {
        // If Spatie roles available, filter by role 'player'
        if (method_exists(User::class, 'role')) {
            return User::role('player')->get();
        }

        // Fallback: return all users
        return User::all();
    }
}
