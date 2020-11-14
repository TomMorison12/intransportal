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

        create('App\City', ['country_id' => $country->id], 6);

        $this->assertEquals($country->fresh()->cities_count, 6);
        //;
    }
}
