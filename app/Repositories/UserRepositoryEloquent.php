<?php

namespace App\Repositories;

use App\Interfaces\IUserRepository;
use App\Models\User;

class UserRepositoryEloquent implements IUserRepository
{
    public function getAll(): array
    {
        $users = User::with('posts')->get();
        return $users->toArray();
    }

    public function getById(int $id): array
    {
        $user = User::with('posts')->where('id', $id)->first();
        return $user->toArray() ?? [];
    }

    public function create(array $data): array
    {
        $user = User::create($data);
        return $user->toArray();
    }

    public function update(array $attributes, int $id): array
    {
        $user = User::where('id', $id)->first();
        if (empty($user)) {
            return [];
        }
        $user->update($attributes);
        return $user->toArray();
    }

    public function delete(int $id): array
    {
        $user = User::where('id', $id)->first();
        if (empty($user)) {
            return [];
        }
        $user->delete();
        return $user->toArray();
    }
}
