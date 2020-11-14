<?php

namespace tests\Feature;

use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use tests\TestCase;

class LockThreadTest extends TestCase
{
    use DatabaseMigrations;

    public function test_non_administrators_may_not_lock_threads()
    {
        $this->signIn();

        $thread = create('App\Thread', ['user_id' => auth()->id()]);
        $this->post(route('locked-threads.store', $thread))->assertStatus(403);

        $this->assertFalse((bool) $thread->fresh()->locked);
    }

    public function test_administrators_can_lock_threads()
    {
        $this->signIn(create('App\User', ['name' => 'John Doe']));

        $thread = create('App\Thread', ['user_id' => auth()->id()]);

        $this->post(route('locked-threads.store', $thread));

        $this->assertTrue((bool) $thread->fresh()->locked);
    }

    public function test_once_locked_a_thread_may_not_receive_new_replies()
    {
        $this->withExceptionHandling();
        $this->signIn();
        $thread = create('App\Thread');

        $thread->lock();

        $this->post($thread->path().'/replies',
        [
            'body' => 'Foobar',
            'user_id' => auth()->id(),

        ])->assertStatus(422);
    }
}
