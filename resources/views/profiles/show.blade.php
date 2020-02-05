@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-2">
    <div class="page-header">
        <h1>{{$profileUser->name}}
        <small>since {{$profileUser->created_at->diffForHumans()}}</small>
        </h1>
        @forelse($activities as $date => $activity)
            <h3 class="page-header">{{ $date }}</h3>
            @foreach($activity as $record)
                @if(view()->exists('profiles.activities.'.$record->type))
            @include('profiles.activities.'.$record->type, ['activity'  => $record])
                @endif
                @endforeach
            @empty
            <p>There is no activity for this user yet</p>
        @endforelse

{{--        {{$threads->links()}}--}}
    </div>
        </div>
    </div>
    </div>


@endsection