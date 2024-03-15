<?php

namespace App\Repositories;

use App\Interfaces\ICommentRepository;
use App\Models\Comment;

class CommentRepositoryEloquent implements ICommentRepository
{
    public function getAll(): array
    {
        $comments = Comment::with('user', 'post')->get();
        return $comments->toArray();
    }

    public function create(array $data): array
    {
        $comment = Comment::create($data);
        return $comment->toArray();
    }

}
