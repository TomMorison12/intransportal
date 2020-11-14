<?php

namespace App\Http\Controllers\Api;

use App\Thread;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LockedThreadsController extends Controller
{

    public function __construct() {
        $this->middleware('admin');
    }


    public function store(Thread $thread) {
    

           $thread->locked ? $thread->unlock() : $thread->lock();
        }

    
}
