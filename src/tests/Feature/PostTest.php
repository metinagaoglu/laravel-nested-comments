<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class PostTest extends TestCase
{

    public function test_successfully()
    {
        $response = $this->get('/api/post/1');

        $response->assertStatus(200);
        $response
            ->assertJson(function (AssertableJson $json) {
                return $json
                    ->has('id')
                    ->has('title')
                    ->has('content')
                    ->has('created_at')
                    ->has('updated_at');
            });
    }

    //TODO: test it fail situation
}
