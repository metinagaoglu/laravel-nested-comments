<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;
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

    public static function calculateDepthByParentId(int $parent_id): int|bool {

        try {
            $parentComment = Comment::where('id',$parent_id)->firstOrFail();
        } catch (ModelNotFoundException $e) {
            return 0; // A new root comment
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return false;
        }

         // For main comment
        $level_of_nested = $parentComment->level_of_nested + 1;
        if ( $parentComment->level_of_nested == 2) {
            $level_of_nested--;
        }
        return $level_of_nested;
    }
}
