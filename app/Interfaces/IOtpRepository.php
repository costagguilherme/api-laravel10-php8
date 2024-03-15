<?php

namespace App\Interfaces;

interface IOtpRepository
{
    public function create(int $userId, string $event): array;
    public function verify(int $userId, string $otp, string $event): bool;
}
