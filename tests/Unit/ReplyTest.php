<?php

namespace Tests\Feature;

use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Reply;
class ReplyTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic feature test example.
     *
     * @return void
     */

  function test_it_has_an_owner() {
      $reply = factory('App\Reply')->create();

      $this->assertInstanceOf('App\User', $reply->owner);
  }

  public function test_it_knows_if_it_was_just_published() {
      $reply = create('App\Reply');

      $this->assertTrue($reply->wasJustPublished());

      $reply->created_at = Carbon::now()->subMonth();

      $this->assertFalse($reply->wasJustpublished());
  }

  function test_it_can_detect_more_than_one_mentioned_users() {

      $reply = create('App\Reply', ['body' => '@JaneDoe wants to talk to @JohnDoe']);

      $this->assertEquals(['JaneDoe', 'JohnDoe'], $reply->mentionedUsers());


  }

  function test_it_wrappes_usernames_in_the_body_with_anchor_tags() {
      $reply = create('App\Reply', ['body' => 'Hello @JaneDoe.']);

      $this->assertEquals(
          'Hello <a href="http://intransportal.test/profiles/JaneDoe">@JaneDoe</a>.',
          $reply->body
      );
  }
}
