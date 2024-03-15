<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Interfaces\ICommentRepository;
use Illuminate\Http\Response;

class CommentController extends Controller
{

    public function __construct(private ICommentRepository $commentRepository)
    {

    }
    public function index(): Response
    {
        $comments = $this->commentRepository->getAll();
        return $this->sendResponse($comments);
    }

    public function store(CommentRequest $request): Response
    {
        $comment = $request->validated();
        $comment = $this->commentRepository->create($comment);
        return $this->sendResponse($comment);
    }
}
