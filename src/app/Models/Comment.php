<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    public $timestamps = true;

    public function subComments() {
        return $this->hasMany(Comment::class,'parent_id');
    }

    // recursive, loads all replices
    public function replies() {
        // Call itself
        return $this->subComments()->with('replies');
    }
}
