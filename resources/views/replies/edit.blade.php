@extends('layouts.master')

@section('title', 'Message Board')

@section('content')
<div class="container" style="width:500px;">
  <div class="justify-content-center" style="width:500px;">
    <div class="card my-5" style="background-color:#c2c2c2;">
      <h5 class="card-header">Message:</h5>
      <div class="card-body">
        <tr>
          <div class="media mb-4">
            <img class="d-flex mr-3 rounded-circle" src="http://127.0.0.1/jf/My%20Project/Project-MessageBoard/public/uploads/avatars/{{ $message->avatar }}" width="60">
            <div class="media-body">
              <h2 class="mt-0" style="word-break: break-all;">{{ $message->name }}</h2>
              <p style="word-break: break-all;">{{ $message->content }}</p>
              <br/>
            </div>
          </div>
        </tr>
        <br/>
        <br/>
        <h5 class="card-footer">Edit your replies:</h5>
        <br/>

        <div class="media mb-4">
          <img class="d-flex mr-3 rounded-circle" src="http://127.0.0.1/jf/My%20Project/Project-MessageBoard/public/uploads/avatars/default.jpg" width="45"/>
          <div class="media-body">
            <h2 class="mt-0" style="word-break: break-all;">{{ $replies->name }}</h2>
            <p style="word-break: break-all;">{{ $replies->content }}</p>
            <br/>
          </div>
        </div>
        <form action="{{ url('replies/{id}') }}" method="POST">
          @method('PUT')
          @csrf
          <div class="form-group">
            <input hidden type="text" name="id" class="form-control" value={{ $replies->id }}>
            <input type="textarea" name="content" class="form-control" rows="3" value={{ $replies->content }}>
            <br>
            <span class="error" role="alert">
            @switch($errors)
                @case($errors->has('content'))
                  <strong>{{ $errors->first('content') }}</strong>
                    @break
                @default
            @endswitch
            </span>
            <button type="submit" class="btn btn-info btn-sm" style="float:right;">更新回覆</button>
          </div>
        </form>
        <br>
        <form action="/jf/My%20Project/Project-MessageBoard/public/replies/{{ $replies->message_id }}" method="GET">
          <div class="form-group">
            <button type="submit" class="btn btn-warning btn-sm" style="float:right;">Back</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@stop
