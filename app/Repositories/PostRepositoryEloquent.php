<?php

namespace App\Repositories;

use App\Interfaces\IPostRepository;
use App\Models\Post;

class PostRepositoryEloquent implements IPostRepository
{
    public function getAll(): array
    {
        $posts = Post::with('user')->get();
        return $posts->toArray();
    }

    public function getById(int $id): array
    {
        $post = Post::with('user')->where('id', $id)->first();
        return $post->toArray() ?? [];
    }

    public function create(array $data): array
    {
        $post = Post::create($data);
        return $post->toArray();
    }

    public function update(array $attributes, int $userId, int $id): array
    {
        $post = Post::where('id', $id)->first();
        if (empty($post)) {
            return [];
        }

        if ($post->user_id != $userId) {
            return ['error' => 'Not possible update this post'];
        }

        $post->update($attributes);
        return $post->toArray();
    }

    public function delete(int $id, int $userId): array
    {
        $post = Post::where('id', $id)->first();
        if (empty($post)) {
            return [];
        }

        if ($post->user_id != $userId) {
            return ['error' => 'Not possible delete this post'];
        }

        $post->delete();
        return $post->toArray();
    }
}
