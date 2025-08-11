<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CommentControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_comment_can_be_created()
    {
        $user = User::factory()->create();
        $post = Post::factory()->create();

        $response = $this->postJson('/api/comments', [
            'body' => 'Nice post!',
            'user_id' => $user->id,
            'post_id' => $post->id
        ]);

        $response->assertStatus(201)
            ->assertJsonFragment(['body' => 'Nice post!']);

        $this->assertDatabaseHas('comments', ['body' => 'Nice post!']);
    }

    public function test_validation_fails_on_empty_body()
    {
        $user = User::factory()->create();
        $post = Post::factory()->create();

        $response = $this->postJson('/api/comments', [
            'body' => '',
            'user_id' => $user->id,
            'post_id' => $post->id
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['body']);
    }

    public function test_comment_can_be_updated()
    {
        $comment = Comment::factory()->create();

        $response = $this->putJson("/api/comments/{$comment->id}", [
            'body' => 'Updated comment',
            'user_id' => $comment->user_id,
            'post_id' => $comment->post_id
        ]);

        $response->assertOk()
            ->assertJsonFragment(['body' => 'Updated comment']);

        $this->assertDatabaseHas('comments', ['body' => 'Updated comment']);
    }

    public function test_comment_can_be_deleted()
    {
        $comment = Comment::factory()->create();

        $response = $this->deleteJson("/api/comments/{$comment->id}");

        $response->assertNoContent();
        $this->assertDatabaseMissing('comments', ['id' => $comment->id]);
    }
}
