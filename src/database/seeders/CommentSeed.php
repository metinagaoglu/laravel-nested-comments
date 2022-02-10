<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


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
            'created_at' => '2022-02-01 10:00:00',
        ]);

        DB::table('comments')->insert([
            'post_id' => 1,
            'username' => Str::random(3),
            'comment' => Str::random(5),
            'level_of_nested' => 1,
            'parent_id' => 1,
            'created_at' => '2022-02-01 11:00:00',
        ]);

        DB::table('comments')->insert([
            'post_id' => 1,
            'username' => Str::random(3),
            'comment' => Str::random(5),
            'level_of_nested' => 1,
            'parent_id' => 1,
            'created_at' => '2022-02-01 11:01:00',
        ]);

        DB::table('comments')->insert([
            'post_id' => 1,
            'username' => Str::random(3),
            'comment' => Str::random(5),
            'level_of_nested' => 2,
            'parent_id' => 2,
            'created_at' => '2022-02-01 11:02:00',
        ]);

        DB::table('comments')->insert([
            'post_id' => 1,
            'username' => Str::random(5),
            'comment' => Str::random(10),
            'created_at' => '2022-02-02 15:00:00',
        ]);

        DB::table('comments')->insert([
            'post_id' => 1,
            'username' => Str::random(3),
            'comment' => Str::random(5),
            'level_of_nested' => 1,
            'parent_id' => 6,
            'created_at' => '2022-02-02 15:10:00',
        ]);

    }
}
