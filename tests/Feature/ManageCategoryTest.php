<?php

namespace tests\Feature;

use App\Country;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ManageCategoryTest extends TestCase
{
    use DatabaseMigrations;

    /**   */

    function test_a_member_can_add_a_category() {
        $this->signIn();
        $category = make('App\Country');

        $this->json("POST", route('country.add'), $category->toArray())->assertStatus(201);


    }



    function test_non_verified_members_may_not_add_new_categories() {

        $category = make('App\Country');

        $this->json("POST", route('country.add'), $category->toArray())->assertStatus(403);


    }

    function test_administrators_can_delete_categories() {
        // given John Doe is signed in
        // john can delete categories

        $this->signIn(create('App\User', ['name' => 'John Doe']));

        $country = create('App\Country');
        $this->assertDatabaseHas('countries', $country->toArray());

        $this->delete(route('country.delete', $country->name));

        $this->assertDatabaseMissing('countries', $country->toArray());
    }

    function test_non_administrators_may_not_delete_categories() {
        $country = create('App\Country');

        $this->delete(route('country.delete', $country->name))->assertStatus(403);
    }

}
