<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        return Post::all();
    }

    public function myPosts(Request $request)
    {
        $user_id = $request->user()->id;
        $posts = Post::where('user_id', $user_id)->orderBy('created_at', 'DESC')->get();
        return response()->json([
            'posts' => $posts
        ]);

    }

    public function store(Request $request)
    {
        try {
            $post = new Post();
            $post->user_id = $request->user()->id;
            $post->title = $request->title;
            $post->body = $request->body;

            if ($post->save()) {
                $response = $post;
                return response()->json(['status' => 'success', 'message' => 'Post created successfully!', 'data' => $response]);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $post = Post::findOrFail($id);
            $post->title = $request->title;
            $post->body = $request->body;

            if ($post->save()) {
                return response()->json(['status' => 'success', 'message' => 'Post updated successfully!']);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        try {
            $post = Post::findOrFail($id);

            if ($post->delete()) {
                return response()->json(['status' => 'success', 'message' => 'Post deleted successfully!']);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
