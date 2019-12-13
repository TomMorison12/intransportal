<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WikiTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic unit test example.
     *
     * @return void
     */

    public function test_a_revision_belongs_to_an_aerticle()
    {
        $article = create('App\Article');

        $revision = create('App\Revision', ['article_id' => $article->id]);
        $this->assertTrue($article->revision->contains($revision));
    }
}
