<?php

namespace App\Repositories;

use App\Domain\Post;
use App\Models\Post as EloquentPost;

class EloquentPostRepository implements PostRepositoryInterface
{
    public function getAll(): array
    {
        return EloquentPost::all()->map(function ($eloquentPost) {
            return new Post($eloquentPost->id, $eloquentPost->title, $eloquentPost->content);
        })->toArray();
    }

    public function findById(int $id): ?Post
    {
        $eloquentPost = EloquentPost::find($id);
        if (!$eloquentPost) {
            return null;
        }
        return new Post($eloquentPost->id, $eloquentPost->title, $eloquentPost->content);
    }

    public function save(Post $post): void
    {
        $eloquentPost = new EloquentPost();
        $eloquentPost->title = $post->title;
        $eloquentPost->content = $post->content;
        $eloquentPost->save();
        $post->id = $eloquentPost->id;
    }

    public function update(Post $post): void
    {
        $eloquentPost = EloquentPost::find($post->id);
        if ($eloquentPost) {
            $eloquentPost->title = $post->title;
            $eloquentPost->content = $post->content;
            $eloquentPost->save();
        }
    }

    public function delete(int $id): void
    {
        EloquentPost::destroy($id);
    }
}
