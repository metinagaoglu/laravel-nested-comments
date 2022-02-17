<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use Illuminate\Support\Facades\Log;

class CommentController extends Controller
{
    public function store(int $id,CommentRequest $request)
    {
        /**
         * Depth server side validation
         */
        $parentComment = Comment::where('id',$request->get('parent_id'))->first();
        $level_of_nested = $parentComment->level_of_nested + 1;
        if ( $parentComment && $parentComment->level_of_nested == 2) {
            $level_of_nested--;
        }

        try {

            $comment = Comment::create([
                'post_id' => $id,
                'username' =>  $request->get('username'),
                'comment' =>  $request->get('comment'),
                'level_of_nested' =>  $level_of_nested,
                'parent_id' => $request->get('parent_id'),
            ]);

            return response()->json($comment)->setStatusCode(201);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['message' => 'Server error'])->setStatusCode(500);
        }

    }

    /**
     * List comments
     */
    public function index(int $id) {
        $comments =  Comment::where('post_id',$id)
            ->orderBy('created_at','DESC')
            ->withDepth()
            ->get()
            ->toTree();

            //return view('welcome');
        return $comments;
    }
}
