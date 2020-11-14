<?php

namespace tests\Unit;

use App\Reply;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use tests\TestCase;

class ReplyTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_it_has_an_owner()
    {
        $reply = factory('App\Reply')->create();

        $this->assertInstanceOf('App\User', $reply->owner);
    }

    public function test_it_knows_if_it_was_just_published()
    {
        $reply = create('App\Reply');

        $this->assertTrue($reply->wasJustPublished());

        $reply->created_at = Carbon::now()->subMonth();

        $this->assertFalse($reply->wasJustpublished());
    }

    public function test_it_can_detect_more_than_one_mentioned_users()
    {
        $reply = create('App\Reply', ['body' => '@JaneDoe wants to talk to @JohnDoe']);

        $this->assertEquals(['JaneDoe', 'JohnDoe'], $reply->mentionedUsers());
    }

    public function test_it_wrappes_usernames_in_the_body_with_anchor_tags()
    {
        $reply = create('App\Reply', ['body' => 'Hello @JaneDoe.']);

        $this->assertEquals(
          'Hello <a href="http://intransportal.test/profiles/JaneDoe">@JaneDoe</a>.',
          $reply->body
      );
    }

    public function test_it_knows_if_it_is_the_best_reply()
    {
        $reply = create('App\Reply');

        $this->assertFalse($reply->isBest());

        $reply->thread->update(['best_reply_id' => $reply->id]);

        $this->assertTrue($reply->fresh()->isBest());
    }
}
