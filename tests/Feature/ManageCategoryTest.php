<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ManageCategoryTest extends TestCase
{
    use DatabaseMigrations;
    /**  */
    public function test_only_members_may_add_categories()
    {
        $this->signIn(create('App\User',['email_verified_at' => null]));
        // when an unverified user posts a catwegory
        $this->json("POST", page_url(null, '/api/category/add'), ['type' => 'Country', 'title' => 'Germany'])->assertStatus(403);
    }

    public function test_categories_get_saved_to_database() {
        $this->signIn();

        $country = create('App\Country');

        $this->json("POST", page_url(null, '/api/category/add'), $country->toArray());

        $this->assertDatabaseHas('countries', $country->toArray());

        $city = create('App\City');

        $this->json("POST", page_url(null, '/api/category/add'), $city->toArray());

        $this->assertDatabaseHas('cities', $city->toArray());

        $mode = create('App\Mode');

        $this->json("POST", page_url(null, '/api/category/add'), $mode->toArray());

        $this->assertDatabaseHas('modes', $mode->toArray());
    }

    function test_illegal_model_types_do_not_get_saved() {
        $this->signIn();
        $this->json("post", page_url(null, '/api/category/add'), ['title' => 'foobar', 'type' => 'User'])->assertStatus(422);
    }
}
