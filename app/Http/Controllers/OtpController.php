<?php

namespace App\Http\Controllers;

use App\Http\Requests\OtpRequest;
use App\Interfaces\IOtpRepository;
use App\Interfaces\IUserRepository;
use App\UseCases\SendOtpUseCase;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class OtpController extends Controller
{

    public function __construct(
        private IOtpRepository $otpRepository,
        private IUserRepository $userRepository,
        private SendOtpUseCase $sendOtpUseCase
    ) {
    }
    public function store(OtpRequest $request): Response
    {
        $data = $request->validated();
        $otp = $this->otpRepository->create($data['user_id'], $data['event']);
        $this->sendOtpUseCase->execute($otp['otp'], $otp['user_id'], $request->method);
        return $this->sendResponse($otp, 'OTP gerado com sucesso');
    }

    public function login(Request $request) : Response
    {
        $token = $this->userRepository->createAuthToken($request->user_id);
        return response(['token' => $token]);
    }
}
