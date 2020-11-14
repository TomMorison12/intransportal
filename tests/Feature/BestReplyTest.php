<?php

namespace tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use tests\TestCase;

class BestReplyTest extends TestCase
{
    use DatabaseMigrations;

    public function test_a_thread_creator_can_mark_any_reply_as_the_best()
    {
        $this->signIn();

        $thread = create('App\Thread', ['user_id' => auth()->id()]);

        $replies = create('App\Reply', ['thread_id' => $thread->id], 2);
        $this->postJson(page_url('forum', "replies/{$replies[1]->id}/best"));
        $this->assertTrue($replies[1]->fresh()->isBest());
    }

    public function test_only_the_thread_creator_may_mark_the_reply_as_best()
    {
        $this->withExceptionHandling();
        $this->signIn();

        $thread = create('App\Thread', ['user_id' => auth()->id()]);

        $replies = create('App\Reply', ['thread_id' => $thread->id], 2);

        $this->signIn(create('App\User'));

        $this->postJson(page_url('forum', "replies/{$replies[1]->id}/best"))->assertStatus(403);

        $this->assertFalse($replies[1]->fresh()->isBest());
    }
}
