<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use App\Thread;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateThreadsTest extends TestCase
{

    use DatabaseMigrations;

    function test_guests_may_not_create_threads() {
        $this->expectException(\Illuminate\Auth\AuthenticationException::class);
        $thread = make('App\Thread');
        $this->withExceptionHandling()->post('/threads', $thread->toArray())->assertRedirect('/login');

        $response = $this->withoutExceptionHandling()->get('/threads/create');
    }
    function test_an_authenticated_user_can_create_new_forum_threads() {

        $this->signIn();
        $thread = make('App\Thread');
        $response = $this->withoutExceptionHandling()->post(page_url('forum', '/threads'), $thread->toArray());
        $this->get($response->headers->get('Location'))
           ->assertSee($thread->title)
        ->assertSee($thread->body);
        }
        function test_a_thread_requires_a_title()
        {
            $this->publishThread(['title' => null])->assertSessionHasErrors(['title']);
        }

        function test_a_thread_requires_a_body()
        {
            $this->publishThread(['body' => null])->assertSessionHasErrors(['body']);
        }

    function test_a_thread_requires_a_channel_id()
    {
        factory('App\Channel', 2)->create();
        $this->publishThread(['channel_id' => 999])->assertSessionHasErrors(['channel_id']);
    }

    function test_guests_cannot_delete_threads() {

        $thread = create('App\Thread');
        $this->delete($thread->path())->assertRedirect(page_url('forum', '/login'));

        $this->signIn();
        $this->delete($thread->path())->assertStatus(403);

    }
//
//    function test_threads_may_only_be_deleted_by_those_who_have_permission() {
//
//    }

    function test_authorized_users_can_delete_threads() {

        $this->signIn();
        $thread = create('App\Thread', ['user_id' => auth()->id()]);
        $reply = create('App\Reply', ['thread_id' => $thread->id]);

       $response = $this->json('DELETE', $thread->path());
        $response->assertStatus(204);
        $this->assertDatabaseMissing('threads', ['id' => $thread->id]);
        $this->assertDatabaseMissing('replies', ['id' => $reply->id]);
    }


        public function publishThread($overrides) {

                $this->withExceptionHandling()->signIn();

                $thread = make('App\Thread', $overrides);

               return $this->post('/threads', $thread->toArray());
            }




}
