@extends('layouts.app')

@section('content')
        <div class="row">

    <div class="col-md-8 offset-4">


            <subcategory country="{{$country}}" cid="{{$cid}}"></subcategory>


    </div>

        </div>
@endsection
