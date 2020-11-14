<?php

namespace tests\Feature;

use App\Trending;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Redis;
use phpDocumentor\Reflection\Types\Void_;
use tests\TestCase;

class TrendingThreadsTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @var Trending
     */
    private $trending;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    protected function setUp() :void
    {
        parent::setUp();

        $this->trending = new Trending();

        $this->trending->reset();
    }

    public function test_it_increments_the_thread_score_each_time_the_thread_is_read()
    {
        $this->assertEmpty($this->trending->get());
        $thread = create('App\Thread');
        $this->call('GET', $thread->path());
        $trending = $this->trending->get();
        $this->assertCount(1, $trending);

        $this->assertEquals($thread->title, $trending[0]->title);
    }
}
