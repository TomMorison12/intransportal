<?php

namespace App\Http\Controllers;


use App\Filters\ThreadFilters;

use App\Trending;
use Illuminate\Http\Request;
use App\Thread;
use App\Channel;
use Auth;
use Illuminate\Support\Facades\Redis;

class ThreadsController extends Controller
{

    public function __construct() {
        $this->middleware('verified')->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @param Channel $channel
     * @param ThreadFilters $filter
     * @param Trending $trending
     * @return \Illuminate\Http\Response
     */
    public function index(Channel $channel, ThreadFilters $filter, Trending $trending)
    {

        $threads = $this->getThread($channel, $filter);
        if(request()->wantsJson()) {
            return $threads;
        }

        $trending->get();


        return view('threads.index', [
            'threads' => $threads,
            'trending' => $trending->get(),
            'page_title' => 'Forum Index'

        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('threads.create');

    }


    public function store(Request $request)
    {
        request()->validate([
            'title' =>'required|spamfree',
            'body' => 'required|spamfree',
            'channel_id' => 'required|exists:channels,id'
        ]);
       $thread = Thread::create([
            'user_id' => Auth::user()->id,
            'channel_id' => request('channel_id'),
            'title' => request('title'),
            'body' => request('body')
        ]);


       return redirect($thread->path())->with('flash', 'Your thread has been published');
    }

    /**
     * Display the specified resource.
     *
     * @param $channelSlug
     * @param Thread $thread
     * @param Trending $trending
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($channelSlug, Thread $thread, Trending $trending)
    {
        if (auth()->check()) {
            auth()->user()->read($thread);

        }
        $trending->push($thread);

        $thread->views()->record();

        return view('threads.show', compact('thread'))->with(['page_title' => $thread->title]);
    }

    /**
     * Show the form for editing the specified resource.
     *        $key= sprintf("users.%s.visits.%s", auth()->id(), $thread->id);

    cache()->forever($key, Carbon::now());
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $channel
     * @return \Illuminate\Http\Response
     */
    public function destroy($channel, Thread $thread)
    {
        $this->authorize("update", $thread);


        $thread->delete();

          if(request()->wantsJson()) {
        return response([], 204);

    }
          return redirect(page_url('forum','/threads'));
    }

    protected function getThread(Channel $channel, ThreadFilters $filter) {
        $threads = Thread::latest()->filter($filter);
        if($channel->exists) {
            $threads->where('channel_id', $channel->id);
        }

        return $threads->paginate(10);

    }
}
