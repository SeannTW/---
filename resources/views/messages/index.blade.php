@extends('layouts.master')

@section('title', 'Message Board')

@section('content')
<div class="container" style="width:500px;">
  <div class="justify-content-center">
    <div class="card my-5" style="background-color:#c5c5c5;border:3px #7e7e7e solid;border-radius:18px;">
      <h5 class="card-header" >MessageBoard:</h5>
      <div class="card-body">
        <form action="{{ route('messages.store') }}" enctype="multipart/form-data" method="POST">
          @csrf
          <div class="form-group" style="float: left; width:78%">
            <input type="text" name="name" class="form-control"  placeholder="Enter you name">
          </div>
          <label class="btn btn-info" style="float: right;">
            <input id="upload_img" style="display:none;" type="file" name="avatar">
            <i class="fa fa-photo"></i>上傳照片
          </label>
          <div class="form-group">
            <textarea class="form-control" name="content" placeholder="Enter you content" rows="3" minlength="1" maxlength="150"></textarea>
          </div>
          <button type="submit" class="btn btn-primary">Save</button>
          <br>
          <span class="error" role="alert">
          @switch($errors)
              @case($errors->has('name') && $errors->has('content'))
                <strong>{{ $errors->first('name') }}</strong><br>
                <strong>{{ $errors->first('content') }}</strong>
                  @break
              @case($errors->has('name'))
                <strong>{{ $errors->first('name') }}</strong>
                  @break
              @case($errors->has('content'))
                <strong>{{ $errors->first('content') }}</strong>
                  @break
              @default
          @endswitch
          </span>
        </form>
        </br>
        </br>
        <p>共 {{ $totalDate }} 筆留言</p>
        <hr size="8px" align="center" width="100%">
        @foreach ($messages as $message)
          <tr>
            <div class="media mb-4">
              <img class="d-flex mr-3 rounded-circle" src="{{ asset('/uploads/avatars/' . $message->avatar) }}" width="60"/>
                <div class="media-body" style="border-radius:18px;background-color:#c9b6b6;">
                  <div style="margin:10px 20px -5px 20px">
                    <font size="1">
                      @if ($message->updated_at)
                        <a>( 已編輯 )</a>
                      @endif
                    </font>
                    <div>
                      <a href="messages/{{ $message->id }}/edit" class="btn btn-default btn-sm" style="float:right;">編輯留言</a>
                      <h2 class="mt-0" style="word-break: break-all;">{{ $message->name }}</h2>
                    </div>
                    @if (!$message->replie_count == 0)
                      <div style="float: right; transform:translate(0px,15px);">
                        有{{ $message->replie_count }}則回覆
                      </div>
                    @endif
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
            </div>
          </tr>
        @endforeach
        <div class="row justify-content-center">
          <p>目前在第 {{ $pageNow }} 頁</p>
        </div>
        <div class="row justify-content-center">
        @for ($i = 0; $i < $totalPage; $i++)
          <form action="{{ route('messages.index') }}" method="GET">
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
