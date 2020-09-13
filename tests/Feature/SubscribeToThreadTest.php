<?php

namespace tests\Feature;

use tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class SubscribeToThreadTest extends TestCase
{
    use DatabaseMigrations;

    public function test_a_user_can_subscribe_to_threads()
    {
        $this->signIn();

        $thread = create('App\Thread');


        $this->post($thread->path() . '/subscribe');

        $this->assertCount(1, $thread->fresh()->subscriptions);




    }
    function test_a_user_can_unsubscribe_from_a_thread() {
        $this->signIn();

        $thread = create('App\Thread');

        $thread->subscribe();

        $this->delete($thread->path() . '/subscribe');
        $thread->fresh();
        $this->assertCount(0, $thread->subscriptions);


    }
}
