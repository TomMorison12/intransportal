<?php

namespace App\Http\Controllers;
use App\Reply;
use App\Thread;
use Auth;
use Illuminate\Http\Request;

class RepliesController extends Controller
{

    public function __construct() {
        $this->middleware('auth')->except('index');
    }
    public function store($channelId, Thread $thread) {
        $this->validate(request(), ['body' => 'required']);
      $reply =  $thread->addReply([
            'body' => request('body'),

            'user_id' => Auth::user()->id
        ]);


        if(request()->wantsJson())
         return $reply->load('owner');

        return back()->with('flash', "Your reply has been left");
    }

    public function destroy(Reply $reply) {
        $this->authorize('update', $reply);
        $reply->delete();
        if(request()->expectsJson()) return response(['status' => 'The reply has been deleted']);

       return back()->with('flash', 'Your reply has been deleted');
    }

    public function update(Reply $reply) {
        $this->authorize('update', $reply);
        $reply->update(['body' => request('body')]);
    }

    public function index($channelId, Thread $thread) {

        return $thread->replies()->paginate(20);

    }
 }
