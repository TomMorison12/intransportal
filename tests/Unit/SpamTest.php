<?php

namespace tests\Unit;

use App\Inspections\Spam;
use tests\TestCase;

class SpamTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     * @throws \Exception
     */
    public function test_it_checks_for_invalid_keywords()
    {
        $spam = new Spam();

        $this->ExpectException(\Exception::class);

        $spam->detect('yahoo customer support');
        $this->assertFalse($spam->detect('Innocent reply here'));
    }

    public function test_it_checks_for_any_key_held_down()
    {
        $spam = new Spam();

        $this->ExpectException(\Exception::class);
        $spam->detect('Hello word aaaaaaaaaaaaaa');
    }
}
