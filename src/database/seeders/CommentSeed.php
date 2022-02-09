<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('comments')->insert([
            'post_id' => 1,
            'username' => Str::random(5),
            'comment' => Str::random(10),
        ]);

        DB::table('comments')->insert([
            'post_id' => 1,
            'username' => Str::random(3),
            'comment' => Str::random(5),
            'level_of_nested' => 1,
            'parent_id' => 1
        ]);

        DB::table('comments')->insert([
            'post_id' => 1,
            'username' => Str::random(3),
            'comment' => Str::random(5),
            'level_of_nested' => 1,
            'parent_id' => 1
        ]);

        DB::table('comments')->insert([
            'post_id' => 1,
            'username' => Str::random(3),
            'comment' => Str::random(5),
            'level_of_nested' => 2,
            'parent_id' => 2
        ]);
    }
}
