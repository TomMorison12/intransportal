<?php

namespace tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use tests\TestCase;

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
        $this->post(page_url('forum', '/replies/1/favorite'))->assertRedirect(page_url(null, '/login'));
    }

    public function test_an_authentcated_user_can_favorite_any_reply()
    {
        $this->signIn();
        $reply = create('App\Reply');

        $this->post(page_url('forum', 'replies/'.$reply->id.'/favorite'));

        $this->assertCount(1, $reply->favorites);
    }

    public function test_an_authentcated_user_can_unfavorite_any_reply()
    {
        $this->signIn();
        $reply = create('App\Reply');

        $reply->favorite();
        $this->assertCount(1, $reply->favorites);
        $this->delete(page_url('forum', '/replies/'.$reply->id.'/favorite'));

        $this->assertCount(0, $reply->fresh()->favorites);
    }

    public function test_an_authenticated_user_may_only_favorite_a_reply_once()
    {
        $this->signIn();
        $reply = create('App\Reply');

        try {
            $this->post(page_url('forum', '/replies/'.$reply->id.'/favorite'));
            $this->post(page_url('forum', '/replies/'.$reply->id.'/favorite'));
        } catch (\Exception $e) {
            $this->fail('Did not expect to insert row twice');
        }

        $this->assertCount(1, $reply->favorites);
    }
}
