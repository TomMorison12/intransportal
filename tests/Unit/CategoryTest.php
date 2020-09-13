<?php

namespace tests\Unit;

use App\Category;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategoryTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic unit test example.
     *
     * @return void
     */

    function test_a_subcategory_belongs_to_a_category() {
        $category = create('App\Category');
        $subcategory = create('App\Subcategory', ['category_id' => $category->id]);
        $this->assertInstanceOf(Category::class, $subcategory->category);
    }

    public function test_a_subcategory_can_be_a_city_or_a_mode() {
        // given we have a category
        // that can have many subcateogories
        // the given subcategori is a polymooirphic relation that can bhe eiuther a city or a mode

        $city = create('App\City');
        $subcategory = create('App\Subcategory', ['subcategory_type' => 'App\City', 'subcategory_id' => $city->id, 'name' => $city->name]);
        $this->assertInstanceOf();

    }
}
