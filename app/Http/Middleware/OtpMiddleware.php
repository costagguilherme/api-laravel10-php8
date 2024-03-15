<?php

namespace App\Http\Middleware;

use App\Exceptions\NotFoundHttpException;
use App\Interfaces\IOtpRepository;
use App\Interfaces\IUserRepository;
use Closure;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OtpMiddleware
{

    public function __construct(
        private IUserRepository $userRepository,
        private IOtpRepository $otpRepository
    )
    {
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $event): Response
    {
        $this->validateRequest($request);
        $user = $this->userRepository->getById($request->user_id);
        if (empty($user)) {
            throw new NotFoundHttpException('User not found');
        }

        $otpIsValid = $this->otpRepository->verify($user['id'], $request->otp, $event);

        if ($otpIsValid) {
            return $next($request);
        }

        throw new AuthenticationException('Invalid otp');
    }

    public function validateRequest(Request $request)
    {
        return $request->validate([
            'otp' => [
                'required',
                'string'
            ]
        ]);
    }
}
