<?php

namespace tests;

use Carbon\Carbon;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function signIn($user = null) {

        $user = $user ?: create('App\User', ['email_verified_at' => Carbon::now()]);

        $this->actingAs($user);

        return $this;
    }

}
