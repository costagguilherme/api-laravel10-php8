<?php

namespace App\Http\Controllers;

use App\Exceptions\NotFoundHttpException;
use App\Http\Requests\PostRequest;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class PostController extends Controller
{
    public function index(): Response
    {
        $posts = Post::with('user')->get();
        return $this->sendResponse($posts->toArray());
    }

    public function show(int $id): Response
    {
        $post = Post::with('user')->where('id', $id)->first();
        if (empty($post)) {
            throw new NotFoundHttpException('Post not found');
        }
        return $this->sendResponse($post->toArray());
    }

    public function store(PostRequest $request): Response
    {
        $post = $request->all();
        $post = Post::create($post);
        return $this->sendResponse($post->toArray());
    }

    public function update(PostRequest $request, int $id): Response
    {
        $post = Post::where('id', $id)->first();
        if (empty($post)) {
            throw new NotFoundHttpException('Post not found');
        }

        if (!($post->user_id == $request->user_id)) {
            throw new BadRequestHttpException('Not possible update this post');
        }

        $user = User::where('id', $request->user_id)->first();
        if (empty($user)) {
            throw new NotFoundHttpException('User not found');
        }

        $post->update($request->all());
        return $this->sendResponse($post->toArray());
    }

    public function destroy(Request $request, int $id): Response
    {
        $post = Post::where('id', $id)->first();
        if (empty($post)) {
            throw new NotFoundHttpException('Post not found');
        }

        if (!($post->user_id == $request->user_id)) {
            throw new BadRequestHttpException('Not possible delete this post');
        }

        $user = User::where('id', $request->user_id)->first();
        if (empty($user)) {
            throw new NotFoundHttpException('User not found');
        }

        $post->delete();
        return $this->sendResponse($post->toArray());
    }
}
