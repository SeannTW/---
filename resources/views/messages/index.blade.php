@extends('layouts.master')

@section('title', 'Message Board')

@section('content')
<div class="container">
  <div class="justify-content-center" style="width:500px;">
    <div class="card my-5">
      <h5 class="card-header">MessageBoard:</h5>
      <div class="card-body">
        <form action="{{ route('messages.store') }}" enctype="multipart/form-data" method="POST">
          @csrf
          <div>
            <label>
              <input type="file" name="avatar">
            </label>
          </div>
          <div class="form-group">
            <input type="text" name="name" class="form-control" placeholder="Enter you name">
          </div>
          <div class="form-group">
            <textarea class="form-control" name="content" placeholder="Enter you content" rows="3"></textarea>
          </div>
          </br>
          <button type="submit" class="btn btn-primary">Save</button>
        </form>
        </br>
        </br>
        <p>共 {{ $totalDate }} 筆留言</p>
        <hr size="8px" align="center" width="100%">
        @foreach ($messages as $message)
          <tr>
            <div class="media mb-4">
              <img class="d-flex mr-3 rounded-circle" src="http://localhost/Larave%20Project/Project-MessageBoard/public/uploads/avatars/{{ $message->avatar }}" width="60"/>
                <div class="media-body">
                  <font size="1">
                    @if ($message->updated_at)
                      <a>( 已編輯 )</a>
                    @endif
                  </font>
                  <div>
                    <a href="messages/{{ $message->id }}/edit" class="btn btn-default btn-sm" style="float:right;">編輯留言</a>
                    <h2 class="mt-0" style="word-break: break-all;">{{ $message->name }}</h2>
                  </div>
                    <h7>{{ $message->created_at }}</h7>
                  </br>
                  </br>
                  <div>
                    <a href="replies/{{ $message->id }}" class="btn btn-info btn-sm" style="float:right;">回覆</a>
                  </div>
                  <p style="word-break: break-all;">{{ $message->content }}</p>
                  <br/>
                </div>
            </div>
          </tr>
        @endforeach
        <div class="row justify-content-center">
          <p>目前在第 {{ $pageNow }} 頁</p>
        </div>
        <div class="row justify-content-center">
        @for ($i = 0; $i < $totalPage; $i++)
          <form action="http://localhost/Larave%20Project/Project-MessageBoard/public/messages" method="GET">
            <div class="form-group">
              <input type="hidden" name="page" class="form-control" value={{ $i + 1 }}>
              <button type="submit" class="btn btn-link">{{ $i + 1 }}</button>
            </div>
          </form>
        @endfor
        </div>
      </div>
    </div>
  </div>
</div>
@stop
