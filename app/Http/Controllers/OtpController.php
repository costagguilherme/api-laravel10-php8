<?php

namespace App\Http\Controllers;

use App\Http\Requests\OtpRequest;
use App\Interfaces\IOtpRepository;
use Illuminate\Http\Response;

class OtpController extends Controller
{

    public function __construct(private IOtpRepository $otpRepository)
    {}
    public function store(OtpRequest $request): Response
    {
        $data = $request->validated();
        $otp = $this->otpRepository->create($data['user_id'], $data['event']);
        return $this->sendResponse($otp, 'OTP gerado com sucesso');
    }
}
