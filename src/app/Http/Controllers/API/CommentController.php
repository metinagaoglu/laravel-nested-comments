<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use App\Traits\ResponsableWithHttp;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class CommentController extends Controller
{
    use ResponsableWithHttp;

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

            return $this->respondSucces('Operation Success',$comment,Response::HTTP_CREATED);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return $this->respondError('Server error');
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
            $comments = Comment::where('post_id',$id)
                ->orderBy('id','DESC')
                ->withDepth()
                ->get()
                ->toTree();

            return $this->respondSucces('Operation Success',$comments,Response::HTTP_OK);
        }
        catch(\Exception $e)
        {
            Log::error($e->getMessage());
            return $this->respondError('Server error');
        }
    }
}
