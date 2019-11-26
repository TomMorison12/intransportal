<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FavoritesTest extends TestCase
{

    use DatabaseMigrations;

    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function test_guests_may_not_favorite_anything()
    {
        $this->post('forum/replies/1/favorite')->assertRedirect('/login');
    }

        public function test_an_authentcated_user_can_favorite_any_reply() {
        $this->signIn();
            $reply = create('App\Reply');


            $this->post('forum/replies/'. $reply->id. '/favorite');

            $this->withoutExceptionHandling()->assertCount(1, $reply->favorites);
        }
}
