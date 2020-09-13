<?php

namespace tests\Unit;

use tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;


class ChannelTest extends TestCase
{
    /** Use databse Migrations */

    use DatabaseMigrations;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    function test_a_channel_consists_of_threads()
    {
        $channel = create('App\Channel');
        $thread = create('App\Thread', ['channel_id' => $channel->id]);

        $this->assertTrue($channel->thread->contains($thread));
    }
}
