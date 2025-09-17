<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function deletePost(Post $post)
    {
        if (auth()->id() != $post->user_id) {
            return redirect('/')->with('error', 'You do not have permission to delete this post.');
        } 
        $post->delete();
        return redirect('/')->with('success', 'Post deleted successfully!');
    }

    public function actuallyUpdatePost(Post $post, Request $request)
    {
        if (auth()->id() != $post->user_id) {
            return redirect('/')->with('error', 'You do not have permission to edit this post.');
        } 
        $incomingFields = request()->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);
        // Sanitize input to prevent XSS
        $incomingFields['title'] = strip_tags($incomingFields['title']);
        $incomingFields['body'] = strip_tags($incomingFields['body']);
        
        $post->update($incomingFields);
        return redirect('/')->with('success', 'Post updated successfully!');
    }

    public function showEditScreen(Post $post)
    {   
        if (auth()->id() != $post->user_id) {
            return redirect('/')->with('error', 'You do not have permission to edit this post.');
        }   
        return view('edit-post', ['post' => $post]);
    }

    public function createPost()
    {
        $incomingFields = request()->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);
        // Sanitize input to prevent XSS
        $incomingFields['title'] = strip_tags($incomingFields['title']);
        $incomingFields['body'] = strip_tags($incomingFields['body']);
        $incomingFields['user_id'] = auth()->id();
        Post::create($incomingFields);
        return redirect('/')->with('success', 'Post created successfully!');
    }
}
