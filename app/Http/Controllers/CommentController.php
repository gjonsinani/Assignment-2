<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        try {
            $comment = new Comment();
            $comment->user_id = $request->user()->id;
            $comment->post_id = $request->post_id;
            $comment->comment = $request->comment;

            if ($comment->save()) {
                return response()->json(['status' => 'success', 'message' => 'Comment added successfully!']);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
