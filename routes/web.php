<?php

use App\Models\Post;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    $posts = [];
    if (auth()->check()) {
        // Get posts of the logged-in user
        $posts = auth()->user()->posts()->latest()->get();
    } else {
        // For guests, show all posts
        $posts = Post::with('user')->latest()->get();
    }

    return view('home', ['posts' => $posts]);
});



Route::post('/register', [UserController::class, 'register'] );
Route::post('/login', [UserController::class, 'login'] );
Route::post('/logout', [UserController::class, 'logout'] );

//Blog posts related routes
Route::post('/create-post', [PostController::class, 'createPost'] );
Route::get('/edit-post/{post}', [PostController::class, 'showEditScreen'] );
Route::put('/edit-post/{post}', [PostController::class, 'actuallyUpdatePost'] );
Route::delete('/delete-post/{post}', [PostController::class, 'deletePost'] );
