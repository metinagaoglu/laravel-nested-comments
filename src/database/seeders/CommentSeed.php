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
            'username' => 'John Doe',
            'comment' => 'Main Node',
            'created_at' => '2022-02-01 10:00:00',
        ]);
        $root->save();


        $node1 = new Comment([
            'post_id' => 1,
            'username' => 'Penelope S. Ortiz',
            'comment' => 'Depth 1',
            'level_of_nested' => 1,
            'parent_id' => 1,
            'created_at' => '2022-02-01 11:00:00',
        ]);
        $node1->save();
        $root->appendNode($node1);

        $node2 = new Comment([
            'post_id' => 1,
            'username' => 'Brent M. Singleton',
            'comment' => 'Depth 2',
            'level_of_nested' => 1,
            'parent_id' => 1,
            'created_at' => '2022-02-01 11:01:00',
        ]);
        $node2->save();
        $node1->appendNode($node2);



    }
}
