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
          <h5 class="card-footer">Replies:</h5>

          <form action="{{ route('replies.store', ['id' => $message->id]) }}" method="POST">
            @csrf
            <div class="form-group">
              <input type="text" name="name" class="form-control" placeholder="Enter you name" value=>
            </div>
            <div class="form-group">
              <textarea class="form-control" name="content" placeholder="Enter you content" rows="3"></textarea>
            </div>
            <div class="form-group">
              <input hidden class="form-control" name="messageId" value={{ $message->id }}>
            </div>
            <button type="submit" class="btn btn-primary" style="float:right;">Save</button>

          </form>
          <br/>
          <br/>
          <a href="/messages" class="btn btn-warning btn-sm" style="float:right;">Go Back</a>
          <br/>
          <br/>
          <br/>
          @foreach ($replies as $replies)
          <tr>
            <div class="media mb-4">
              <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
                <div class="media-body" style="display:inline;">
                  <form action="{{ route('replies.edit', ['id' => $replies->id]) }}" method="GET">
                    @csrf
                    <button type="submit" style="float:right;">Edit</button>
                  </form>
                  <h5 class="mt-0">{{ $replies->name }}</h5>
                  


                  <p>{{ $replies->content }}</p>
                  <br/>
                </div>
            </div>
          </tr>
        @endforeach

        </div>
      </div>

    </div>
  </div>
@stop
