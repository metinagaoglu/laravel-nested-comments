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
    public function test_successfully()
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
                ->has('replies')
                ->etc()
            )
            );
    }
}
