<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Traits\ResponsableWithHttp;
use Illuminate\Support\Facades\Log;

class PostController extends Controller
{
    use ResponsableWithHttp;

    public function show(Post $post) {
        try{
            return $this->respondSucces('Operation Successfuly',$post);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return $this->respondError('Server error');
        }
    }
}
