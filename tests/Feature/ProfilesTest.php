<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProfilesTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_a_user_has_a_profile()
    {
        $user = create('App\User');
        $this->get("/profiles/{$user->name}")->assertSee($user->name);

    }

    function test_profiles_display_all_threads_by_user() {

        $this->signIn();

        $thread = create('App\Thread', ['user_id' => auth()->id()]);

        $this->get("http://".env('APP_DOMAIN')."/profiles/".auth()->user()->name)->assertSee($thread->title)->assertSee($thread->body);

}

}
