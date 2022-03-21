<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use App\Traits\ResponsableWithHttp;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpFoundation\Response;

class CommentController extends Controller
{
    use ResponsableWithHttp;

    /**
     * @param int $id
     * @param CommentRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(int $id,CommentRequest $request): Response
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
        } catch (ModelNotFoundException $e) {
            return $this->respondError(__('Invalid parent id'),422);
        }

        return $this->respondSucces(payload: $comment,httpStatus: Response::HTTP_CREATED);
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function index(int $id): Response
    {
        $comments = Comment::where('post_id',$id)
            ->orderBy('created_at','DESC')
            ->withDepth()
            ->get()
            ->toTree();

        return $this->respondSucces(payload: $comments);

    }
}
