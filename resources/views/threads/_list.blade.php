@forelse($threads as $thread)
    <div class="card">
        <div class="card-header">
            <div class="level">
                <div class="flex">
                    <h3>
                        <a href="{{ $thread->path() }}">
                            @if(auth()->check() && $thread->hasUpdatesFor(auth()->user()))
                                <strong>
                                    {{$thread->title}}
                                </strong>
                            @else
                                {{$thread->title}}
                            @endif
                        </a></h3>

                    <h4>Posted by: <a href="{{route('profile', $thread->creator) }}">{{$thread->creator->name }}</a></h4>
                </div>
                <strong><a href="{{$thread->path()}}">{{ $thread->replies_count }} {{ str_plural('reply', $thread->replies_count) }}</a></strong>
            </div>
        </div>
        <div class="card-body">
            <div class="body">{{$thread->body}}</div>

        </div>
        <div class="card-footer">
            {{ $thread->views()->count() }} views
        </div>
    </div>
@empty
    <p>There are no relevant results at this time</p>

@endforelse
