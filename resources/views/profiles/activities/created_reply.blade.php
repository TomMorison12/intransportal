@component('profiles.activities.activity')
    @slot('heading')
      @php
@endphp
        {{$profileUser->name}} posted a reply to <a href="{{$activity->subject->thread->path()}}">{{$activity->subject->thread->title}}</a>

        @endslot
    @slot('body')

    {{$activity->subject->body}}
    @endslot
    @endcomponent


