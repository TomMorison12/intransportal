<?php

namespace tests\Feature;

use Exception;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use tests\TestCase;

class ParticipateInForumTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_unauthenticated_users_may_not_participate_in_thread()
    {
        $thread = create('App\Thread');
        $this->post($thread->path().'/replies', [])->assertRedirect(page_url('forum', 'email/verify'));

        $user = factory('App\User')->create();

        $this->be($user);
        $thread = factory('App\Thread')->create();
        $reply = factory('App\Reply')->make();

        $this->post($thread->path().'/replies', $reply->toArray());

        $this->assertDatabaseHas('replies', ['body' => $reply->body]);
        $this->assertEquals(1, $thread->fresh()->replies_count);
    }

    public function test_a_reply_requires_a_body()
    {
        $this->signIn();

        $thread = create('App\Thread');
        $reply = make('App\Reply', ['body' => null]);

        $this->post($thread->path().'/replies', $reply->toArray())->assertSessionHasErrors(['body']);
    }

    public function test_unauthorized_users_cannot_delete_replies()
    {
        $reply = create('App\Reply');

        $this->delete(page_url('forum', 'replies/'.$reply->id))->assertRedirect(page_url('forum', 'email/verify'));
        $this->signIn()->delete(page_url('forum', 'replies/'.$reply->id))->assertStatus(403);
    }

    public function test_authorized_users_can_update_replies()
    {
        $this->signIn();
        $reply = create('App\Reply', ['user_id' => auth()->id()]);
        $this->patch(page_url('forum', 'replies/'.$reply->id), ['body' => "You've been changed, punk"]);

        $this->assertDatabaseHas('replies', ['id' => $reply->id, 'body' => "You've been changed, punk"]);
    }

    public function test_authorized_users_can_delete_replies()
    {
        $this->signIn();
        $reply = create('App\Reply', ['user_id' => auth()->id()]);
        $this->delete(page_url('forum', "/replies/{$reply->id}"));
        $this->assertDatabaseMissing('replies', ['id' => $reply->id]);
        $this->assertEquals(0, $reply->thread->fresh()->replies_count);
    }

    public function test_unauthorized_users_cannot_update_replies()
    {
        $reply = create('App\Reply');

        $this->patch(page_url('forum', 'replies/'.$reply->id))->assertRedirect(page_url('forum', 'email/verify'));
        $this->signIn()->patch(page_url('forum', 'replies/'.$reply->id))->assertStatus(403);
    }

    public function test_replies_that_contain_spam_may_not_be_created()
    {
        $this->signIn();

        $thread = create('App\Thread');

        $reply = make('App\Reply', [
            'body' => 'yahoo customer support',
        ]);

        $this->json('post', $thread->path().'/replies', $reply->toArray())
            ->assertStatus(422);
    }

    public function test_a_user_may_only_post_once_per_minute()
    {
        $this->withExceptionHandling();
        $this->signIn();

        $thread = create('App\Thread');
        $reply = make('App\Reply', [
            'body' => 'my simple reply',
        ]);
        $this->post($thread->path().'/replies', $reply->toArray())->assertStatus(201);
        $this->post($thread->path().'/replies', $reply->toArray())->assertStatus(429);
    }
}
