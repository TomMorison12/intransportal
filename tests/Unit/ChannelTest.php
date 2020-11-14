<?php

namespace tests\Unit;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use tests\TestCase;

class ChannelTest extends TestCase
{
    /** Use databse Migrations */
    use DatabaseMigrations;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_a_channel_consists_of_threads()
    {
        $channel = create('App\Channel');
        $thread = create('App\Thread', ['channel_id' => $channel->id]);

        $this->assertTrue($channel->thread->contains($thread));
    }
}
