<?php

namespace App\Http\Controllers;

use App\Exceptions\NotFoundHttpException;
use App\Http\Requests\PostRequest;
use App\Interfaces\IPostRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class PostController extends Controller
{
    public function __construct(private IPostRepository $postRepository)
    {
    }


    public function index(): Response
    {
        $posts = $this->postRepository->getAll();
        return $this->sendResponse($posts);
    }

    public function show(int $id): Response
    {
        $post = $this->postRepository->getById($id);
        if (empty($post)) {
            throw new NotFoundHttpException('Post not found');
        }
        return $this->sendResponse($post);
    }

    public function store(PostRequest $request): Response
    {
        $post = $request->validated();
        $post = $this->postRepository->create($post);
        return $this->sendResponse($post);
    }

    public function update(PostRequest $request, int $id): Response
    {
        $post = $this->postRepository->update($request->validated(), $request->user_id, $id);
        if (empty($post)) {
            throw new NotFoundHttpException('Post not found');
        }

        if (isset($post['error'])) {
            throw new BadRequestHttpException($post['error']);
        }

        return $this->sendResponse($post);
    }

    public function destroy(Request $request, int $id): Response
    {
        $post = $this->postRepository->delete($id, $request->user_id);
        if (empty($post)) {
            throw new NotFoundHttpException('Post not found');
        }

        if (isset($post['error'])) {
            throw new BadRequestHttpException($post['error']);
        }

        return $this->sendResponse($post);
    }
}
