<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
