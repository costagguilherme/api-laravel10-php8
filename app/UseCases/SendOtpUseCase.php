<?php

namespace App\UseCases;

use App\Interfaces\IUserRepository;
use App\Mail\SendOtpEmail;
use Illuminate\Support\Facades\Mail;

class SendOtpUseCase
{

    public function __construct(private IUserRepository $userRepository)
    {
    }
    public function execute(string $otp, string $userId, string $method): void
    {
        $user = $this->userRepository->getById($userId);
        if ($method == 'email') {
            Mail::to($user['email'])->send(new SendOtpEmail($otp));
        }
    }
}
