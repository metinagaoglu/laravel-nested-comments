<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;

class CommentController extends Controller
{
    public function store(int $id,CommentRequest $request)
    {

        $level_of_nested = Comment::calculateDepthByParentId((int) $request->get('parent_id'));

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
     * @param int $id
     * @return \Illuminate\Http\JsonResponse|object
     */
    public function index(int $id) {
        try
        {
            return Comment::where('post_id',$id)
                ->orderBy('created_at','DESC')
                ->withDepth()
                ->get()
                ->toTree();
        }
        catch(\Exception $e)
        {
            Log::error($e->getMessage());
            return response()->json(['message' => 'Server error'])->setStatusCode(500);
        }
    }
}
