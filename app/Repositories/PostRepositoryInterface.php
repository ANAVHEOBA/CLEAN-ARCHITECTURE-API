<?php

namespace App\Repositories;

use App\Domain\Post;

interface PostRepositoryInterface
{
    public function getAll(): array;
    public function findById(int $id): ?Post;
    public function save(Post $post): void;
    public function update(Post $post): void;
    public function delete(int $id): void;
}
