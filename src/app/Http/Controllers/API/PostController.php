<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Traits\ResponsableWithHttp;
use Illuminate\Http\Response;

class PostController extends Controller
{
    use ResponsableWithHttp;

    /**
     * @param Post $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post): Response
    {
        return $this->respondSucces(payload: $post);
    }
}
