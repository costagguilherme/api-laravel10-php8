<?php

namespace App\Interfaces;

interface IPostRepository
{
    public function getAll(): array;

    public function getById(int $id): array;

    public function create(array $data): array;
    public function update(array $attributes, int $userId, int $id): array;

    public function delete(int $id, int $userId): array;
}
