<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ThreadTest extends TestCase
{
    protected $thread;
    /**
     * A basic unit test example.
     *
     * @return void
     */

    use DatabaseMigrations;
    public function setUp() :void {
        parent::setUp();

        $this->thread = factory('App\Thread')->create();
    }

    function test_a_thread_can_make_a_string_path() {
        $thread = create('App\Thread');

        $this->assertEquals(page_url('forum', '/threads/'. $thread->channel->slug.'/'.$thread->id), $thread->path());

    }

    public function test_a_thread_has_replies()
    {


        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $this->thread->replies);



    }

    function test_a_thread_has_a_creator()
    {

        $this->assertInstanceOf('App\User', $this->thread->creator);

    }

    public function test_a_thread_can_add_a_reply() {
        $this->thread->addReply([
            'body' => 'fooBar',
            'user_id' => 1
        ]);

        $this->assertCount(1, $this->thread->replies);




    }

    function test_a_thread_belongs_to_a_channel() {
        $thread = create('App\Thread');

        $this->assertInstanceOf('App\Channel', $thread->channel);
    }
}
