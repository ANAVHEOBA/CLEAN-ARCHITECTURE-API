<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostApiController;



// List all posts
Route::get('posts', [PostApiController::class, 'index']);

// Get a single post by ID
Route::get('posts/{id}', [PostApiController::class, 'show']);

// Create a new post
Route::post('posts', [PostApiController::class, 'store']);

// Update an existing post by ID
Route::put('posts/{id}', [PostApiController::class, 'update']);

// Delete a post by ID
Route::delete('posts/{id}', [PostApiController::class, 'destroy']);
