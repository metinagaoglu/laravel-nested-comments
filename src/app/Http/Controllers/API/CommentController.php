<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    public function store(int $id,Request $request)
    {
        //TODO: validation and save
        echo $id;
        dd($request->all());
    }

    public function index(int $id) {
        return Comment::where('post_id',$id)
            ->whereNull('parent_id')
            ->orderBy('created_at','DESC')
            ->with('replies')
            ->get();
    }
}
