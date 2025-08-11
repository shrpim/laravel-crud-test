<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_post_can_be_created()
    {
        $user = User::factory()->create();

        $response = $this->postJson('/api/posts', [
            'body' => 'Post content here',
            'user_id' => $user->id
        ]);

        $response->assertStatus(201)
            ->assertJsonFragment(['body' => 'Post content here']);

        $this->assertDatabaseHas('posts', ['body' => 'Post content here']);
    }

    public function test_validation_fails_on_empty_title()
    {
        $user = User::factory()->create();

        $response = $this->postJson('/api/posts', [
            'body' => '',
            'user_id' => $user->id
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['body']);
    }

    public function test_post_can_be_updated()
    {
        $post = Post::factory()->create();

        $response = $this->putJson("/api/posts/{$post->id}", [
            'body' => 'Updated content',
        ]);

        $response->assertOk()
            ->assertJsonFragment(['body' => 'Updated content']);

        $this->assertDatabaseHas('posts', ['body' => 'Updated content']);
    }

    public function test_post_can_be_deleted()
    {
        $post = Post::factory()->create();

        $response = $this->deleteJson("/api/posts/{$post->id}");

        $response->assertNoContent();
        $this->assertDatabaseMissing('posts', ['id' => $post->id]);
    }
}
