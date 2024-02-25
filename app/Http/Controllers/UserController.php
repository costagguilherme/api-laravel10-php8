<?php

namespace App\Http\Controllers;

use App\Exceptions\NotFoundHttpException;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    public function index(): Response
    {
        $users = User::all();
        return $this->sendResponse($users->toArray());
    }

    public function show(int $id): Response
    {
        $user = User::where('id', $id)->first();
        if (empty($user)) {
            throw new NotFoundHttpException('Usuário não encontrado');
        }
        return $this->sendResponse($user->toArray());
    }

    public function store(UserRequest $request): Response
    {
        $user = $request->validated();
        $user = User::create($user);
        return $this->sendResponse($user->toArray());
    }

    public function update(UserRequest $request, int $id): Response
    {
        $user = User::where('id', $id)->first();
        if (empty($user)) {
            throw new NotFoundHttpException('Usuário não encontrado');
        }
        $attributes = $request->validated();
        $user->update($attributes);
        return $this->sendResponse($user->toArray());
    }

    public function destroy(int $id): Response
    {
        $user = User::where('id', $id)->first();
        if (empty($user)) {
            throw new NotFoundHttpException('Usuário não encontrado');
        }
        $user->delete();
        return $this->sendResponse($user->toArray());
    }
}
