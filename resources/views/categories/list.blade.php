@extends('layouts.app')

@section('content')
<div class="container">

    <div class="col-md-6 offset-3">

        <subcategory country="{{$country}}" cid="{{$cid}}" slug="{{$slug}}"></subcategory>
    </div>

</div>


@endsection



