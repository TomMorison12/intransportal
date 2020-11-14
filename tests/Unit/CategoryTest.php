<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategoryTest extends TestCase
{
use DatabaseMigrations;

function test_it_counts_the_cities_in_countries()
{

    $country = create('App\Country');

    create('App\City', ['country_id' => $country->id], 6);

    $this->assertEquals($country->fresh()->cities_count,  6);
//;


}


}

