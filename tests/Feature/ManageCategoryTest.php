<?php

namespace tests\Feature;

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
        $category = make('App\Category');

        $this->json("POST", route('category.add'), $category->toArray());
        $this->assertDatabaseHas('categories', $category->toArraY());


    }

}
