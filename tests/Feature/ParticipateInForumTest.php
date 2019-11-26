<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ParticipateInForumTest extends TestCase
{
    use DatabaseMigrations;    /**
     * A basic feature test example.
     *
     * @return void
     */

    function test_unauthenticated_users_may_not_participate_in_thread() {

        $this->expectException(\Illuminate\Auth\AuthenticationException::class);
        $this->withoutExceptionHandling()->post('/forum/threads/some-channel/1/replies', []);

    }
  function test_an_authenticated_user_can_pariticipate_inm_forum_threads() {
      $user = factory('App\User')->create();

      $this->be($user);
      $thread = factory('App\Thread')->create();
      $reply = factory('App\Reply')->make();

      $this->post($thread->path().'/replies', $reply->toArray());

      $this->get($thread->path())->assertSee($reply->body);
  }

  function test_a_reply_requires_a_body() {
        $this->withExceptionHandling()->signIn();

        $thread = create('App\Thread');
        $reply = make('App\Reply', ['body' => null]);

        $this->post($thread->path(). '/replies', $reply->toArray())
        ->assertSessionHasErrors(['body']);
  }
}
