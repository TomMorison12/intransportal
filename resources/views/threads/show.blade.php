@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="level">
                            <span class="flex"><a href="{{url('profiles/'.$thread->creator->name)}}">{{ $thread->creator->name}}</a> posted {{$thread->title}}</span>
                            @can('update', $thread)
                            <form action="{{$thread->path()}}" method="post">
                            {{csrf_field()}}
                            {{method_field('DELETE')}}
                            <button type="submit" class="btn btn-link">Delete</button>
                        </form>
                        @endcan
                        </div>
                    </div>

                    <div class="card-body">
                        {!! nl2br(e($thread->body)) !!}
                    </div>
                </div>

                @foreach($replies as $reply)
                    @include('threads.reply')

                @endforeach

                {{ $replies->links() }}

                @if(auth()->check())

                    <form method="post" action="{{$thread->path() . '/replies'}}">
                        {{ csrf_field() }}
                        <div class="form-group mt-2">
                            <textarea rows="5" name="body" id="body" class="form-control" placeholder="Have something to say?"></textarea>
                            <button type="submit" name="submit" class="btn btn-primary">Post</button>
                        </div>
                    </form>



                @else
                    <p class="text-center">Please <a href="{{route('login')}}">login</a> to participate in this discussion</p>
                @endif
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        This thread was published {{$thread->created_at->diffForHumans()}} by <a href="#">{{$thread->creator->name}}</a> and currently has {{$thread->replies_count}} {{str_plural('reply', $thread->replies_count)}}
                    </div>
                </div>
            </div>
        </div>



    </div>


@endsection


