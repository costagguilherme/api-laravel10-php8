<?php

namespace App\Http\Controllers;

use App\Exceptions\NotFoundHttpException;
use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Repositories\UserRepositoryEloquent;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{

    private UserRepositoryEloquent $userRepository;
    public function __construct(UserRepositoryEloquent $userRepository)
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

    public function update(UserRequest $request, int $id): Response
    {
        $user = $this->userRepository->update($request->validated(), $id);
        if (empty($user)) {
            throw new NotFoundHttpException('Usuário não encontrado');
        }

        return $this->sendResponse($user);
    }

    public function destroy(int $id): Response
    {
        $user = $this->userRepository->delete($id);
        if (empty($user)) {
            throw new NotFoundHttpException('Usuário não encontrado');
        }
        return $this->sendResponse($user);
    }
}
