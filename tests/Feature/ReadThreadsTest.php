<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;



class ReadThreadsTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic test example.
     *
     * @return void
     */

    public function setUp() :void {

        parent::setUp();

        $this->thread = factory('App\Thread')->create();



    }
    public function test_a_user_can_read_all_threads()
    {


        $response = $this->get(page_url('forum','/threads'));

        $response->assertSee($this->thread->title);


    }

    function a_user_can_read_a_single_thread() {

        $this->get(page_url('forum', '/threads/' . $this->thread->id))->assertSee($this->thread->title);
    }

    function a_user_can_read_replies_that_are_associated_with_a_thread() {

        $reply = factory('App\Reply')->create(['thread_id' => $this->thread->id]);

        $this->get(page_url('forum','/threads/'. $this->thread->id))->assertSee($reply->body);

    }

    function test_a_user_can_filter_threads_according_to_channel() {
        $channel = create('App\Channel');
        $threadInChannel = create('App\Thread', ['channel_id' => $channel->id]);
        $threadNotInChannel = create('App\Thread');
        $this->withoutExceptionHandling()->get(page_url('forum', '/threads/'.$channel->slug))->assertSee($threadInChannel->title)->assertDontSee($threadNotInChannel->title);
    }

    function test_a_user_can_filter_threads_by_any_username() {
        $this->signIn(create('App\User', ['name' => 'JohnDoe']));

        $threadByJohn = create('App\Thread', ['user_id'=> auth()->user()->id]);

        $threadNotByJohn = create('App\Thread');

        $this->withoutExceptionHandling()->get(page_url('forum', '/threads?by=JohnDoe'))->assertSee($threadByJohn->title)->assertDontSee($threadNotByJohn->title);
    }

    function test_a_user_can_filter_threads_by_popularity() {
        $threadWithTwoReplies = create('App\Thread');
        create('App\Reply', ['thread_id' => $threadWithTwoReplies->id], 2);

        $threadWithThreeReplies = create('App\Thread');
        create('App\Reply', ['thread_id' => $threadWithThreeReplies->id], 3);
        $threadWithNoReplies = $this->thread;


        $response = $this->getJson(page_url('forum', '/threads?popular=1'))->json();

        $this->assertEquals([3,2,0], array_column($response, 'replies_count'));
    }

    function test_a_user_can_request_all_replies_for_a_thread() {
      $thread = create('App\Thread');
        create('App\Reply', ['thread_id' => $thread->id], 2);

       $response = $this->getJson($thread->path(). '/replies')->json();
       

       $this->assertCount(1, $response['data']);
       $this->assertEquals(2, $response['total']);
    }
}
