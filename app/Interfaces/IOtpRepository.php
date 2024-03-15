<?php

namespace App\Interfaces;

interface IOtpRepository
{
    public function create(int $userId, string $event): array;
}
