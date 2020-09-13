<?php

namespace tests\Unit;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PhotoTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_a_photo_belongs_to_a_category()
    {
        $this->assertTrue(true);
    }
}
