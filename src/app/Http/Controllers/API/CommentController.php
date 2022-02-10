<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    public function store(int $id,Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|max:50',
            'comment' => 'required',
            'level_of_nested' => 'required|numeric|between:0,3',
            'parent_id' => 'required|numeric',
        ]);

        /**
         * Depth server side validation
         */
        $level_of_nested = $request->get('level_of_nested');
        $parentComment = Comment::where('id',$request->get('parent_id'))->first();
        if ($parentComment->level_of_nested == 2) {
            $level_of_nested--;
        }

        $comment = new Comment();
        $comment->post_id = $id;
        $comment->username = $request->get('username');
        $comment->comment = $request->get('comment');
        $comment->level_of_nested = $level_of_nested;
        $comment->parent_id = $request->get('parent_id');
        if( !$comment->save() ) {
            return response()->json(['message' => 'server error'])->setStatusCode(500);
        }

        return response()->json($comment)->setStatusCode(201);
    }

    public function index(int $id) {
        return Comment::where('post_id',$id)
            ->whereNull('parent_id')
            ->orderBy('created_at','DESC')
            ->with('replies')
            ->get();
    }
}
