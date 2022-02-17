<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Support\Facades\Log;

class PostController extends Controller
{
    public function show(Post $post) {
        try{
            return $post;
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['message' => 'Server error'])->setStatusCode(500);
        }
    }
}
