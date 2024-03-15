<?php

namespace App\Interfaces;

interface IUserRepository
{
    public function createAuthToken(int $userId): string;
    public function getAll(): array;
    public function getById(int $id): array;
    public function create(array $data): array;
    public function update(array $attributes, int $id): array;
    public function delete(int $id): array;
}
