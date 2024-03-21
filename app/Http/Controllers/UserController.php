<?php

namespace App\Http\Controllers;

use App\Exceptions\NotFoundHttpException;
use App\Http\Requests\UserRequest;
use App\Interfaces\IUserRepository;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{

    private IUserRepository $userRepository;
    public function __construct(IUserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    public function index(): Response
    {
        $users = $this->userRepository->getAll();
        return $this->sendResponse($users);
    }

    public function show(int $id): Response
    {
        $user = $this->userRepository->getById($id);
        if (empty($user)) {
            throw new NotFoundHttpException('Usuário não encontrado');
        }
        return $this->sendResponse($user);
    }

    public function store(UserRequest $request): Response
    {
        $user = $request->validated();
        $user = $this->userRepository->create($user);
        return $this->sendResponse($user);
    }

    public function update(UserRequest $request): Response
    {
        $user = $this->userRepository->update($request->validated(), $request->user_id);
        if (empty($user)) {
            throw new NotFoundHttpException('Usuário não encontrado');
        }

        return $this->sendResponse($user);
    }

    public function destroy(Request $request): Response
    {
        $user = $this->userRepository->delete($request->user_id);
        if (empty($user)) {
            throw new NotFoundHttpException('Usuário não encontrado');
        }
        return $this->sendResponse($user);
    }
}
