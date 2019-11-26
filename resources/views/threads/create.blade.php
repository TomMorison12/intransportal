@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Create a New Thread</div>
                    <form method="post" action="/forum/threads">

                        {{csrf_field()}}

                    <div class="card-body">
                        <div class="form-group">
                            <div class="form-group">
                                <label for="channel">Choose a channel:</label>
                                <select class="form-control" name="channel_id" id="channel_id" required>
                                    <option>Choose one:</option>
                                    @foreach($channels as $channel)

                                        <option value="{{$channel->id}}" {{old('channel_id') == $channel->id ? 'selected' : ''}}>{{$channel->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        <div class="form-group">
                            <label for="title">TItle:</label>
                            <input type="text" class="form-control" name="title" value="{{old('title')}}" required/>
                        </div>
                        </div>

                      <div class="form-group">
                          <label for="body">Body:</labeL>
                          <textarea name="body" class="form-control" id="body" rows="8" required>{{old('body')}}</textarea>
                      </div>

                        <input type="submit" name="submit" class="btn btn-primary" value="Post" />
                        <div class="form-hroup">
                            @if(count($errors))
                            @foreach($errors->all() as $error)
                                <ul class="alert alert-danger">
                                    <li>{{$error}}</li>
                                </ul>
                        @endforeach
                        @endif
                        </div>


                    </form>

            </div>
        </div>
    </div>
@endsection
