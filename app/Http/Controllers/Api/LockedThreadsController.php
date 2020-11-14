<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Thread;
use Illuminate\Http\Request;

class LockedThreadsController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function store(Thread $thread)
    {
        $thread->locked ? $thread->unlock() : $thread->lock();
    }
}
