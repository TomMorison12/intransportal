<?php

namespace Tests\Unit;

use App\City;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Country;
class CategoryTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_a_category_can_be_three_levels_deep()
    {
        // Given we have a first-level category (couintry)
        // That has many cities
        // Which has many modes/lines
        // theey all have working relationships

       $country = create('App\Country', ['name' => 'United Kingdom']);
       $city = create('App\City', ['name' => 'London', 'country_id' => $country->id]);
       $mode = create('App\Mode', ['name' => 'London Underground', 'city_id' => $city->id]);

        $this->assertInstanceOf(City::class, $mode->city);

    }
}
