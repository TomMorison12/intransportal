<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use DatabaseMigrations;

    public function test_it_counts_the_cities_in_countries()
    {
        $country = create('App\Country');

        create('App\City', ['country_id' => $country[0]->id], 6);

        $this->assertEquals($country->fresh()[0]->cities_count, 6);
        //;
    }
//
//    function test_a_mode_belomgs_to_a_city() {
//        // given we have a city
//        // and we have a mode, line, or station
//        // that category can be;ong to that city.
//
//
//    }
}
