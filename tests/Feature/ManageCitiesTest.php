<?php

namespace Tests\Feature;

use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ManageCitiesTest extends TestCase
{
    use  DatabaseMigrations;

    function test_a_verified_member_can_add_a_city_to_a_country() {
        $this->signIn(create('App\User', ['email_verified_at' => Carbon::now()]));

        $city = make('App\City');

        $this->json("post", route('cities.add'), $city->toArray());

        $this->assertDatabaseHas('cities', $city->toArray());


    }

    function test_non_verified_users_may_not_add_categories() {
        $city = make('App\City');

        $this->json("post", route('cities.add'), $city->toArray())->assertStatus(403);
    }

    function test_a_city_requires_a_name() {
        $this->signIn();
        $city = make('App\City', ['name' => null]);
        $this->post(route('cities.add'), $city->toarray())->assertSessionHasErrors([ 'name']);


    }
}
