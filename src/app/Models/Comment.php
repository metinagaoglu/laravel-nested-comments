<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class Comment extends Model
{
    use HasFactory,NodeTrait;

    /**
     * The attributes that are mass assignable.
     * https://laravel.com/docs/8.x/eloquent#mass-assignment
     * @var array
     */
    protected $fillable = [
        'post_id',
        'username',
        'comment',
        'level_of_nested',
        'parent_id'
    ];

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
