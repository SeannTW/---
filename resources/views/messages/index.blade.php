@extends('layouts.master')

@section('title', 'Message Board')

@section('content')
<div class="container">
  <div class="justify-content-center" style="width:500px;">
    <div class="card my-5">
      <h5 class="card-header">MessageBoard:</h5>
      <div class="card-body">
        <form action="{{ route('messages.store') }}" method="POST">
          @csrf
          <div class="form-group">
            <input type="text" name="name" class="form-control" placeholder="Enter you name" value=>
          </div>
          <div class="form-group">
            <textarea class="form-control" name="content" placeholder="Enter you content" rows="3"></textarea>
          </div>
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
      </div>
    </div>
    @foreach ($messages as $message)
      <tr>
        <div class="media mb-4">
          <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
            <div class="media-body">
              <div ="float:right;">
                <a href="replies/{{ $message->id }}" class="btn btn-warning btn-sm" style="float:right;">Replies</a>
              </div>
              <h5 class="mt-0">{{ $message->name }}</h5>
              </br>
              <form action="{{ route('messages.destroy', $message->id) }}" method="POST">
                @method('DELETE')
                @csrf
                <button type="submit" class="btn btn-danger btn-sm" style="float:right; ">Delete</button>
              </form>
                <a href="messages/{{ $message->id }}/edit" class="btn btn-info btn-sm" style="float:right;">Edit</a>
                <p>{{ $message->content }}</p>
                <br/>
            </div>
        </div>
      </tr>
    @endforeach
  </div>
</div>
@stop
