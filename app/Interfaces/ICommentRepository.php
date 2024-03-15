<?php

namespace App\Interfaces;

interface ICommentRepository
{
    public function getAll(): array;
    public function create(array $data): array;
}
