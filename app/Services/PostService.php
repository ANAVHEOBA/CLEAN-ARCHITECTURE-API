<?php

namespace App\Services;

use App\Repositories\PostRepositoryInterface;
use App\Domain\Post;

class PostService
{
    private $postRepository;

    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function listPosts(): array
    {
        return $this->postRepository->getAll();
    }

    public function getPostById(int $id): ?Post
    {
        return $this->postRepository->findById($id);
    }

    public function createPost($title, $content): void
    {
        $post = new Post(null, $title, $content);
        $this->postRepository->save($post);
    }

    public function updatePost(int $id, $title, $content): void
    {
        $post = new Post($id, $title, $content);
        $this->postRepository->update($post);
    }

    public function deletePost(int $id): void
    {
        $this->postRepository->delete($id);
    }
}
