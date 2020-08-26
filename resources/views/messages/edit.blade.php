@extends('layouts.master')

@section('title', 'Message Board')

@section('content')
<div class="container">
  <div class="justify-content-center" style="width:500px;">
    <div class="card my-5">
      <h5 class="card-header">Edit message</h5>
      <div class="card-body">
        <form action="{{ route('messages.update') }}" method="POST">
          @method('PUT')
          @csrf
          <div class="form-group">
            <input hidden type="text" name="id" class="form-control" value={{ $message->id }}>
            <h2 class="mt-0" style="word-break: break-all;">{{ $message->name }}</h2>
            <input type="textarea" name="content" class="form-control" rows="3" style="word-break: break-all;" value={{ $message->content }}>
          </div>
          <button style="float:right;" type="submit" class="btn btn-info btn-sm">Update</button>
          <br/>
          <br/>
          <a style="float:right;" href="/messages" class="btn btn-primary btn-sm">Back</a>
        </form>
      </div>
    </div>
  </div>
</div>
@stop
