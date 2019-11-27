<div class="card mt-2">

    <div class="card-header">
        <div class="card-level">
        <a href="$">{{ $reply->owner->name }}</a> said {{ $reply->created_at->diffForHumans()}}</div>
</div>
<div class="flex">
    <form action="">
        <button type="submit" class="btn btn-default">Favorite</button>
    </form>
</div>
    <div class="card-body">
{{!! nl2br(e($reply->body)) !!}}

    </div>
</div>
