<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Comment;


class CommentSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $root = new Comment([
            'post_id' => 1,
            'username' => Str::random(5),
            'comment' => Str::random(10),
            'created_at' => '2022-02-01 10:00:00',
        ]);
        $root->save();


        $node1 = new Comment([
            'post_id' => 1,
            'username' => Str::random(3),
            'comment' => Str::random(5),
            'level_of_nested' => 1,
            'parent_id' => 1,
            'created_at' => '2022-02-01 11:00:00',
        ]);
        $node1->save();
        $root->appendNode($node1);

        $node2 = new Comment([
            'post_id' => 1,
            'username' => Str::random(3),
            'comment' => Str::random(5),
            'level_of_nested' => 1,
            'parent_id' => 1,
            'created_at' => '2022-02-01 11:01:00',
        ]);
        $node2->save();
        $node1->appendNode($node2);



    }
}
