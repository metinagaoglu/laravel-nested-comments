<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class CommentTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_fetch_successfully()
    {
        $response = $this->get('/api/post/1/comment');
        $response->assertStatus(200);
        $response
            ->assertJson(fn (AssertableJson $json) => $json->has('0', fn(AssertableJson $json) =>
            $json
                ->has('post_id')
                ->has('parent_id')
                ->has('username')
                ->has('comment')
                ->has('level_of_nested')
                ->has('created_at')
                ->has('updated_at')
                ->has('children')
                ->etc()
            ));
    }

    public function test_make_comment()
    {
        $response = $this->post('/api/post/1/comment',[
            'post_id' => 1,
            'username' => 'test',
            'comment' => 'test content of comment',
            'level_of_nested' => 0,
            'parent_id' => 0,
        ]);
        $response->assertStatus(201);
        $response
            ->assertJson(fn (AssertableJson $json) =>
            $json
                ->has('post_id')
                ->has('parent_id')
                ->has('username')
                ->has('comment')
                ->has('level_of_nested')
                ->has('created_at')
                ->has('updated_at')
                ->etc()
            );

        //TODO: check also DB
    }
}
