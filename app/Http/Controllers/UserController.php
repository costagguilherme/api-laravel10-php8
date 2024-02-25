<?php

namespace App\Http\Controllers;

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

    public function store(Request $request): Response
    {
        $user = $request->all();
        $user = User::create($user);
        return $this->sendResponse($user->toArray());
    }
}
