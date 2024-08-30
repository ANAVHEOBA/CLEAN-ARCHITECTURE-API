<?php

namespace App\Http\Controllers;

use App\Services\PostService;
use Illuminate\Http\Request;
use App\Domain\Post;

class PostApiController extends Controller
{
    private $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    public function index()
    {
        return response()->json($this->postService->listPosts());
    }

    public function show($id)
    {
        $post = $this->postService->getPostById($id);
        if (!$post) {
            return response()->json(['message' => 'Post not found'], 404);
        }
        return response()->json($post);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $this->postService->createPost($request->title, $request->content);
        return response()->json(['message' => 'Post created successfully'], 201);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $post = $this->postService->getPostById($id);
        if (!$post) {
            return response()->json(['message' => 'Post not found'], 404);
        }

        $this->postService->updatePost($id, $request->title, $request->content);
        return response()->json(['message' => 'Post updated successfully']);
    }

    public function destroy($id)
    {
        $post = $this->postService->getPostById($id);
        if (!$post) {
            return response()->json(['message' => 'Post not found'], 404);
        }

        $this->postService->deletePost($id);
        return response()->json(['message' => 'Post deleted successfully']);
    }
}
