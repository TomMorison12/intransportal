@extends('layouts.app')

@section('content')
    <thread-view :thread="{{$thread}}" inline-template>
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="level">
                            @if($thread->creator->avatar_path)
                            <img src="{{asset('/storage/'.$thread->creator->avatar_path)}}" width="25" height="25" class="mr-1" />
                            @endif
                            <span class="flex"><a href="{{page_url(null, 'profiles/'.$thread->creator->name)}}">{{ $thread->creator->name}}</a> posted {{$thread->title}}</span>
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
                <replies @added="repliesCount++" @remove="repliesCount--"></replies>

{{--                @foreach($replies as $reply)--}}
{{--                    @include('threads.reply')--}}

{{--                @endforeach--}}

{{--


{{--                @else--}}
{{--                    <p class="text-center">Please <a href="{{route('login')}}">login</a> to participate in this discussion</p>--}}
{{--                @endif--}}
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        This thread was published {{$thread->created_at->diffForHumans()}} by <a href="#">{{$thread->creator->name}}</a> and currently has <span v-text="repliesCount"></span> {{str_plural('reply', $thread->replies_count)}}
                        <p>
                        <subscribe-button v-if="signedIn" :active="{{json_encode($thread->isSubscribedTo)}}"></subscribe-button>
                        <button class="btn btn-default" v-if="authorize('isAdmin')" @click="lock" v-text="locked ? 'Unlock' : 'Lock'"></button>
                        </p>
                    </div>
                </div>
            </div>
        </div>



    </div>
    </thread-view>

@endsection


