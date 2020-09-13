<?php

namespace tests\Unit;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_a_user_can_fetch_their_most_recent_post() {
        $user = create('App\User');

        $reply = create('App\Reply', ['user_id' => $user->id]);


        $this->assertEquals($reply->id, $user->latestReply->id);
    }
}
