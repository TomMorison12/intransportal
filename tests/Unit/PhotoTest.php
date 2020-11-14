<?php

namespace tests\Unit;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use tests\TestCase;

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
