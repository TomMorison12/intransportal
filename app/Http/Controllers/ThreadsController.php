<?php

namespace App\Http\Controllers;


use App\Filters\ThreadFilters;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Thread;
use App\Channel;
use Auth;
class ThreadsController extends Controller
{

    public function __construct() {
        $this->middleware('auth')->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @param Channel $channel
     * @param \App\Http\Controllers\ThreadFilters $filter
     * @return \Illuminate\Http\Response
     */
    public function index(Channel $channel, ThreadFilters $filter)
    {

        $threads = $this->getThread($channel, $filter);
        if(request()->wantsJson()) {
            return $threads;
        }


        return view('threads.index', compact('threads'))->with(['page_title' => 'Forum Index']);
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

    /**
//     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(request(), [
            'title' =>'required',
            'body' => 'required',
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
     * @param  int  $id

     */
    public function show($channelSlug, Thread $thread)
    {
        if (auth()->check()) {
            auth()->user()->read($thread);
        }
        return view('threads.show', compact('thread'));
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

        return $threads->get();

    }
}
