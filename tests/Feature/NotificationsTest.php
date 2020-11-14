<?php

namespace tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Notifications\DatabaseNotification;
use tests\TestCase;

class NotificationsTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    protected function setUp() : void
    {
        parent::setUp();
        $this->signIn();
    }

    public function test_a_user_receives_a_notification_when_a_thread_is_updated()
    {
        $thread = create('App\Thread')->subscribe();

        $thread->addReply([
            'user_id' => auth()->id(),
            'body' => 'Give me a reply body, master',
        ]);

        $this->assertCount(0, auth()->user()->fresh()->notifications);

        $thread->addReply([
            'user_id' => create('App\User')->id,
            'body' => 'Give me a reply body, master',
        ]);
        $this->assertCount(1, auth()->user()->fresh()->notifications);
    }

    public function test_a_user_can_fetch_their_unread_notifications()
    {
        create(DatabaseNotification::class);

        $this->assertCount(1, $this->getJson(page_url(null, '/profiles/'.auth()->user()->name.'/notifications/'))->json());
    }

    public function test_a_user_can_clear_all_notifications()
    {
        create(DatabaseNotification::class);

        $this->assertCount(1, auth()->user()->unreadNotifications);

        $notificationId = auth()->user()->unreadNotifications->first()->id;

        $this->delete(page_url(null, '/profiles/'.auth()->user()->name.'/notifications/'.$notificationId));
        $this->assertCount(0, auth()->user()->fresh()->unreadNotifications);
    }
}
