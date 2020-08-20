<form action="{{ route('messages.update', ['message' => $message]) }}" method="POST">
    @method('PUT')
    @csrf
    <label>姓名：
        <textarea name="name">{{ $message->name }}</textarea>
    </label><br>
    <label>標題：
        <textarea name="title">{{ $message->title }}</textarea>
    </label><br>
    <label>內容：
        <textarea name="content">{{ $message->content }}</textarea>
    </label><br>
    <input type="submit" value="送出文章">
</form>
<form action="{{ route('messages'.destroy') }}" method="POST">
    @method('DELETE')
    @csrf
    <input type="submit" value="刪除文章">
</form>