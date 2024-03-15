<?php

namespace App\Repositories;

use App\Interfaces\ICommentRepository;
use App\Interfaces\IOtpRepository;
use App\Models\Comment;
use App\Models\Otp;

class OtpRepositoryEloquent implements IOtpRepository
{
    public function create(int $userId, string $event): array
    {
        $otp = (string) rand(100000, 999999);
        $minutes = Otp::MINUTES;
        $availableUntil = new \DateTime("+{$minutes} minutes");
        $otp = Otp::create([
            'user_id' => $userId,
            'event' => $event,
            'otp' => $otp,
            'available_until' => $availableUntil
        ]);

        return $otp->toArray();
    }

    public function verify(int $userId, string $otp, string $event): bool
    {
        $datetime = new \DateTime();

        $otp = Otp::where('otp', $otp)
            ->where('user_id', $userId)
            ->where('event', $event)
            ->where('available_until', '>=', $datetime->format('Y-m-d H:i:s'))
            ->first();

        if (empty($otp)) {
            return false;
        }

        $otp->delete();
        return true;
    }

}
