<div class="card mt-2">

    <div class="card-header">
        <div class="level">
            <h5 class="flex">
        <a href="{{url('profiles/'. $reply->owner->name)}}">{{ $reply->owner->name }}</a> said {{ $reply->created_at->diffForHumans()}}
            </h5>
@if(auth()->check())

<div>
    <form action="/forum/replies/{{$reply->id}}/favorite" method="post">
        {{ csrf_field() }}
        <button type="submit" class="btn btn-default" {{$reply->isFavorited() ? 'disabled' : ''}}>
        {{$reply->favorites_count}} {{str_plural('Favorites', $reply->favorites_count)}}</button>
    </form>
</div>
@endif
</div>
</div>

<div class="card-body">
    {!! nl2br(e($reply->body)) !!}

</div>
</div>
