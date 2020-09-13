<?php

namespace tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MentionUsersTest extends TestCase
{
    use DatabaseMigrations;

    function test_mentioned_users_in_a_reply_are_notified() {
        $john = create('App\User', ['name' => 'JohnDoe']);
        $this->signIn($john);
        $jane = create('App\User', ['name' => 'JaneDoe']);
        $thread = create('App\Thread');
        $reply = make('App\Reply', ['body' => '@JaneDoe']);
        $this->json('post', $thread->path(). '/replies', $reply->toArray());
        $this->assertCount(1, $jane->notifications);
    }
}
