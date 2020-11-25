@extends('layouts.master')

@section('title', 'Message Board')

@section('content')
<div class="container" style="width:500px;">
  <div class="justify-content-center" style="width:500px;">
    <div class="card my-5" style="background-color:#c2c2c2;">
      <h5 class="card-header">Edit message</h5>
      <div class="card-body">
        <form action="{{ route('messages.destroy', $message->id) }}" method="POST">
          @method('DELETE')
          @csrf
          <button type="submit" class="btn btn-danger btn-sm" style="float:right; ">刪除留言</button>
        </form>
        <form action="{{ route('messages.update') }}" method="POST">
          @method('PUT')
          @csrf
          <div class="form-group">
            <input hidden type="text" name="id" class="form-control" value={{ $message->id }}>
            <h2 class="mt-0" style="word-break: break-all;">{{ $message->name }}</h2>
            <input type="textarea" name="content" class="form-control" rows="3" style="word-break: break-all;" value={{ $message->content }}>
          </div>
          <span class="error" role="alert">
            @switch($errors)
                @case($errors->has('content'))
                  <strong>{{ $errors->first('content') }}</strong>
                    @break
                @default
            @endswitch
            </span>
          <button style="float:right;" type="submit" class="btn btn-info btn-sm">更新留言</button>
          <br/>
          <br/>
          <a style="float:right;" href="{{ route('messages.index') }}" class="btn btn-warning btn-sm">Back</a>
        </form>
      </div>
    </div>
  </div>
</div>
@stop
