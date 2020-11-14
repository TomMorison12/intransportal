<?php

namespace tests\Unit;

use App\Notifications\ThreadWasUpdated;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Redis;
use tests\TestCase;

class ThreadTest extends TestCase
{
    protected $thread;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    use DatabaseMigrations;

    public function setUp() :void
    {
        parent::setUp();

        $this->thread = factory('App\Thread')->create();
    }

    public function test_a_thread_can_make_a_string_path()
    {
        $thread = create('App\Thread');

        $this->assertEquals(page_url('forum', 'threads/'.$thread->channel->slug.'/'.$thread->slug), $thread->path());
    }

    public function test_a_thread_has_replies()
    {
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $this->thread->replies);
    }

    public function test_a_thread_has_a_creator()
    {
        $this->assertInstanceOf('App\User', $this->thread->creator);
    }

    public function test_a_thread_can_add_a_reply()
    {
        $this->thread->addReply([
            'body' => 'fooBar',
            'user_id' => 1,
        ]);

        $this->assertCount(1, $this->thread->replies);
    }

    public function test_a_thread_belongs_to_a_channel()
    {
        $thread = create('App\Thread');

        $this->assertInstanceOf('App\Channel', $thread->channel);
    }

    public function test_a_thread_can_be_subscribed_to()
    {
        $thread = create('App\Thread');
        $this->signIn();
        $thread->subscribe();
        $this->assertEquals(1, $thread->subscriptions()->where('user_id', auth()->id())->count());
    }

    public function test_a_thread_can_be_unsubscribed_from()
    {
        $thread = create('App\Thread');
        $thread->subscribe($userId = 1);
        $thread->unsubscribe($userId = 1);

        $this->assertCount(0, $thread->subscriptions);
    }

    public function test_it_knows_when_the_authenticated_user_subscribed_to_it()
    {
        $this->signIn();
        $thread = create('App\Thread');
        $this->assertFalse($thread->isSubscribedTo);
        $thread->subscribe();
        $this->assertTrue($thread->isSubscribedTo);
    }

    public function test_it_notifies_all_subscribers_when_a_reply_is_added()
    {
        Notification::fake();
        $this->signIn()->thread->subscribe()->addReply([
            'body' => 'fooBar',
            'user_id' =>  999,
        ]);

        Notification::assertSentTo(auth()->user(), ThreadWasUpdated::class);
    }

    public function test_a_thread_can_check_if_an_Authenticated_user_read_all_replies()
    {
        $this->signIn();

        $thread = create('App\Thread');

        $this->assertTrue($thread->hasUpdatesFor(auth()->user()));

        cache()->forever(auth()->user()->visitedThreadCacheKey($thread), \Carbon\Carbon::now());

        $this->assertFalse($thread->hasUpdatesFor(auth()->user()));
    }

    public function test_a_thread_records_each_visit()
    {
        $thread = make('App\Thread', ['id' => 1]);

        $thread->views()->reset();
//        $thread->resetViews();

        $this->assertSame(0, $thread->views()->count());

        $thread->views()->record();

//
        $this->assertEquals(1, $thread->views()->count());

        $thread->views()->record();
//
        $this->assertEquals(2, $thread->views()->count());
    }

    public function test_a_thread_may_be_locked()
    {
        $this->assertFalse($this->thread->locked);

        $this->thread->lock();

        $this->assertTrue($this->thread->locked);
    }
}
