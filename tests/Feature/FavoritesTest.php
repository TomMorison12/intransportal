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
        $this->post('/replies/1/favorite')->assertRedirect('/login');
    }

        public function test_an_authentcated_user_can_favorite_any_reply() {
        $this->signIn();
            $reply = create('App\Reply');


            $this->post('/replies/'. $reply->id. '/favorite');

            $this->withoutExceptionHandling()->assertCount(1, $reply->favorites);
        }


        function test_an_authenticated_user_may_only_favorite_a_reply_once() {
            $this->signIn();
            $reply = create('App\Reply');

            try {
                $this->post(page_url('forum', '/replies/' . $reply->id . '/favorite'));
                $this->post(page_url('forum', '/replies/' . $reply->id . '/favorite'));
            } catch(\Exception $e) {
                $this->fail('Did not expect to insert row twice');
            }

            $this->withoutExceptionHandling()->assertCount(1, $reply->favorites);
        }



}
