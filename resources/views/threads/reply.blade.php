<reply :attributes="{{$reply}}" inline-template v-cloak>
<div id="reply-{{$reply->id}}" class="card mt-2">

    <div class="card-header">
        <div class="level">
            <h5 class="flex">
        <a href="{{url('profiles/'. $reply->owner->name)}}">{{ $reply->owner->name }}</a> said {{ $reply->created_at->diffForHumans()}}
            </h5>
@if(auth()->check())

<div>
  @if(Auth::check())
    <favorite :reply="{{$reply}}"></favorite>
    @endif
</div>
@endif
</div>
</div>

<div class="card-body">
    <div v-if="editing">
       <div class="form-group">
           <textarea class="form-control" v-model="body"></textarea>
           <button class="btn btn-sm btn-primary" @click="update">Update</button>
           <button class="btn btn-sm btn-link" @click="editing = false">Cancel</button>
       </div>
    </div>
    <div v-else v-text="body">

    </div>
</div>
    @can('update', $reply)
    <div class="panel-footer level">
        <button class="btn btn-sm" style="margin-right: 1em" @click="editing = true">Edit</button>
        <button class="btn btn-danger btn-sm" style="margin-right: 1em" @click="destroy">Delete</button>

    </div>
        @endcan

</div>
</reply>
