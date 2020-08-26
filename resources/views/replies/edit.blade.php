@extends('layouts.master')

@section('title', 'Message Board')

@section('content')
<div class="container">
  <div class="justify-content-center" style="width:500px;">
    <div class="card my-5">
      <h5 class="card-header">Message:</h5>
      <div class="card-body">
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
        <br/>
        <br/>
        <h5 class="card-footer">Edit your replies:</h5>
        <br/>

        <div class="media mb-4">
          <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
          <div class="media-body">
            <h5 class="mt-0">{{ $replies->name }}</h5>
            <p>{{ $replies->content }}</p>
            <br/>
          </div>
        </div>
        <form action="{{ route('replies.update') }}" method="POST">
          @method('PUT')
          @csrf
          <div class="form-group">
            <input hidden type="text" name="id" class="form-control" value={{ $replies->id }}>
            <input type="textarea" name="content" class="form-control" rows="3" value={{ $replies->content }}>
            <br>
            <button type="submit" class="btn btn-info btn-sm">Update</button>
          </div>
        </form>
        <form action="/replies/{{ $replies->id }}" method="POST">
          @method('DELETE')
          @csrf
          <div class="form-group" style="float:right;">
            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
          </div>
        </form>
        <form action="/replies/{{ $replies->message_id }}" method="GET">
          <div class="form-group">
            <button type="submit" class="btn btn-warning btn-sm">Back</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@stop
