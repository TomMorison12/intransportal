<?php

namespace Tests\Unit;

use App\Spam;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SpamTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     * @throws \Exception
     */
    public function test_it_detects_spam() {
        $spam = new Spam();

        $this->assertFalse($spam->detect('Innocent reply here'));


    }

}
