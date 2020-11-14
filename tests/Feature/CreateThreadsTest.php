<?php

namespace tests\Feature;

use App\Rules\Recaptcha;
use App\Thread;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use tests\TestCase;

class CreateThreadsTest extends TestCase
{
    use DatabaseMigrations;

    protected function setUp() : void
    {
        parent::setUp();

        app()->singleton(Recaptcha::class, function () {
            $m = \Mockery::mock(Recaptcha::class);
            $m->shouldReceive('passes')->andReturn(true);

            return $m;
        });
    }

    public function test_guests_may_not_create_threads()
    {
        $thread = make('App\Thread');
        $this->withoutExceptionHandling()->post(page_url('forum', '/threads'), $thread->toArray())->assertRedirect(page_url('forum', 'email/verify'));
    }

    public function test_an_authenticated_user_can_create_new_forum_threads()
    {
        $this->signIn();
        $thread = make('App\Thread');
        $response = $this->post(page_url('forum', '/threads'), $thread->toArray() + ['g-recaptcha-response' => 'test']);

        $this->withoutExceptionHandling()->get($response->headers->get('Location'))
          ->assertSee($thread->title)
        ->assertSee($thread->body);
    }

    public function test_a_thread_requires_a_title()
    {
        $this->publishThread(['title' => null])->assertSessionHasErrors(['title']);
    }

    public function test_a_thread_requires_a_body()
    {
        $this->publishThread(['body' => null])->assertSessionHasErrors(['body']);
    }

    /* @test */

    public function test_a_thread_requires_recaptcha_verification()
    {
        unset(app()[Recaptcha::class]);
        $this->publishThread(['g-recaptcha-response' => 'test'])
                ->assertSessionHasErrors('g-recaptcha-response');
    }

    public function test_a_thread_requires_a_channel_id()
    {
        factory('App\Channel', 2)->create();
        $this->publishThread(['channel_id' => 999])->assertSessionHasErrors(['channel_id']);
    }

    public function test_a_thread_requires_a_unique_slug()
    {
        $this->signIn();
//
        $thread = create('App\Thread', ['title' => 'Foo title']);
//
        $this->assertEquals($thread->fresh()->slug, 'foo-title');

        $this->post(page_url('forum', '/threads'), $thread->toArray() + ['g-recaptcha-response' => 'test']);
        $this->assertTrue(Thread::where('slug', 'foo-title-2')->exists());

        $this->post(page_url('forum', '/threads'), $thread->toArray() + ['g-recaptcha-response' => 'test']);
        $this->assertTrue(Thread::where('slug', 'foo-title-3')->exists());
    }

    public function test_a_thread_with_a_title_that_ends_in_a_number_should_generate_a_proper_slug()
    {
        $this->signIn();

        $thread = create('App\Thread', ['title' => 'Some title 24', 'slug' => 'some-title-24']);

        $this->post(page_url('forum', '/threads'), $thread->toArray() + ['g-recaptcha-response' => 'test']);

        $this->assertTrue(Thread::where('slug', 'some-title-24-2')->exists());
    }

    public function test_guests_cannot_delete_threads()
    {
        $thread = create('App\Thread');
        $this->delete($thread->path())->assertRedirect(page_url('forum', 'email/verify'));

        $this->signIn();
        $this->delete($thread->path())->assertStatus(403);
    }

//
//    function test_threads_may_only_be_deleted_by_those_who_have_permission() {
//
//    }

    public function test_authorized_users_can_delete_threads()
    {
        $this->signIn();
        $thread = create('App\Thread', ['user_id' => auth()->id()]);
        $reply = create('App\Reply', ['thread_id' => $thread->id]);

        $response = $this->json('DELETE', $thread->path());
        $response->assertStatus(204);
        $this->assertDatabaseMissing('threads', ['id' => $thread->id]);
        $this->assertDatabaseMissing('replies', ['id' => $reply->id]);
        $this->assertDatabaseMissing('activities', ['subject_id' => $thread->id, 'subject_type' => get_class($thread)]);
        $this->assertDatabaseMissing('activities', ['subject_id' => $reply->id, 'subject_type' => get_class($reply)]);
    }

    public function test_a_thread_can_be_updated()
    {
        $this->withExceptionHandling();

        $this->signIn();

        $thread = create('App\Thread', ['user_id' => auth()->id()]);

        $this->patch($thread->path(), [
                'title' => 'Changed',
                'body' => 'Changed body.',
            ]);

        $this->assertEquals('Changed', $thread->fresh()->title);
        $this->assertEquals('Changed body.', $thread->fresh()->body);
    }

    public function test_a_thread_requires_a_title_and_body_to_be_updated()
    {
        $this->signIn();
        $thread = create('App\Thread', ['user_id' => auth()->id()]);

        $this->patch($thread->path(), [
            'title' => 'Changed',

        ])->assertSessionHasErrors(['body']);

        $this->patch($thread->path(), [
            'body' => 'Changed',

        ])->assertSessionHasErrors(['title']);
    }

    public function test_unauthorized_users_may_not_update_threads()
    {
        $this->withExceptionHandling();
        $this->signIn();

        $thread = create('App\Thread', ['user_id' => create('App\User')->id]);

        $this->patch($thread->path(), [
            'title' => 'Changed',
            'body' => 'Changed body.',
        ])->assertStatus(403);
    }

    public function publishThread($overrides)
    {
        $this->signIn();

        $thread = make('App\Thread', $overrides);

        return $this->post(page_url('forum', '/threads'), $thread->toArray());
    }
}
