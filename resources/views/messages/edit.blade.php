@extends('layouts.master')

@section('title', 'Message Board')

@section('content')
<div class="container">
  <div class="justify-content-center" style="width:500px;">
    <div class="card my-5">
      <h5 class="card-header">Edit message content:</h5>
      <div class="card-body">
        <form action="{{ route('messages.update', ['message' => $message]) }}" method="POST">
          @method('PUT')
          @csrf
          <div class="form-group">
            <h5 class="mt-0">{{ $message->name }}</h5>
              <input type="textarea" name="content" class="form-control" rows="3" value={{ $message->content }}>
          </div>
          <button type="submit" class="btn btn-info btn-sm">Update</button>
          <br/>
          <br/>
          <a href="/messages" class="btn btn-primary btn-sm">Back</a>
        </form>
      </div>
    </div>
    <tr>
      <div class="media mb-4">
        <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
          <div class="media-body">
            <h5 class="mt-0">{{ $message->name }}</h5>
            <p>{{ $message->content }}</p>
            <br/>
          </div>
      </div>
    </tr>
  </div>
</div>
@stop
