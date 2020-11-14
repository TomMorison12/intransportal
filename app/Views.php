<?php

namespace App;

use Illuminate\Support\Facades\Redis;

class Views
{
    protected $thread;

    public function __construct($thread)
    {
        $this->thread = $thread;
    }

    public function count()
    {
        return Redis::get($this->cacheKey()) ?? 0;
    }

    public function reset()
    {
        Redis::del($this->cacheKey());
    }

    public function record()
    {
        Redis::incr($this->cacheKey());
    }

    protected function cacheKey()
    {
        return "threads.{$this->thread->id}.visits";
    }
}
