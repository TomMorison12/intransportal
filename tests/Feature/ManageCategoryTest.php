<?php

namespace tests\Feature;

use App\Country;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use tests\TestCase;

class ManageCategoryTest extends TestCase
{
    use DatabaseMigrations;

    public function test_a_member_can_add_a_category()
    {
        $this->signIn();
        $category = make('App\Category');

        $this->json('POST', route('country.add'), ['name' => $category->name])->assertStatus(201);
    }

    public function test_non_verified_members_may_not_add_new_categories()
    {
        $category = make('App\Country');

        $this->json('POST', route('country.add'), $category->toArray())->assertStatus(403);
    }

    public function test_administrators_can_delete_categories()
    {
        // given John Doe is signed in
        // john can delete categories

        $this->signIn(create('App\User', ['name' => 'John Doe']));

        $country = create('App\Country');
        $this->assertDatabaseHas('countries', $country->toArray());

        $this->delete(route('country.delete', $country->name));

        $this->assertDatabaseMissing('countries', $country->toArray());
    }

    public function test_non_administrators_may_not_delete_categories()
    {
        $country = create('App\Country');

        $this->delete(route('country.delete', $country->name))->assertStatus(403);
    }
}
