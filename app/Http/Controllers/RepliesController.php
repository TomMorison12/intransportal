<?php

namespace App\Http\Controllers;

use App\Http\Forms\CreatePostForm;
use App\Notifications\YouWereMentioned;
use App\Reply;

use App\Thread;
use App\User;
use Auth;

use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RepliesController extends Controller
{


    public function __construct() {
        $this->middleware('verified')->except('index');
    }

    /**
     * @param $channelId
     * @param Thread $thread
     * @param CreatePostForm $form

     */
    public function store($channelId, Thread $thread, CreatePostForm $form)
    {
        if($thread->locked) {
            return response('The thread is locked', 422);
        }
           return $thread->addReply([
                'body' => request('body'),

                'user_id' => Auth::user()->id
            ])->load('owner');
    }

    public function destroy(Reply $reply) {
        $this->authorize('update', $reply);
        $reply->delete();
        if(request()->expectsJson()) return response(['status' => 'The reply has been deleted']);

       return back()->with('flash', 'Your reply has been deleted');
    }

    public function update(Reply $reply) {
    $this->authorize('update', $reply);

    // $this->validate(request(), ['body' => 'required|spamfree']);

    $reply->update(request()->validate([
        'body' => 'required|spamfree'
    ]));
    }

    public function index($channelId, Thread $thread) {

        return $thread->replies()->paginate(20);

    }




}
