@extends('layouts.master')

@section('title', 'Message Board')

@section('content')
    <div class="container">
      <div class="justify-content-center" style="width:500px;">
        <div class="card my-5">
          <h5 class="card-header">MessageBoard:</h5>
          <div class="card-body">
            <form>
              <div class="form-group">
                <textarea class="form-control" rows="3"></textarea>
              </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
          </div>
        </div>
        @foreach($messages as $message)
        <tr>
          <div class="media mb-4">
            <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
              <div class="media-body">
                <h5 class="mt-0">{{ $message->name }}</h5>
                  <a href="messages/{{ $message->id }}" class="btn btn-info btn-sm" class="justify-content-end" style="float:right;">Edit</a>
                  <p>{{ $message->content }}</p>
                  <br/>
              </div>
          </div>
        </tr>
        @endforeach
      </div>
    </div>
@endsection