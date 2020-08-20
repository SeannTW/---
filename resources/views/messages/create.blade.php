<form action="{{ route('messages.store') }}" method="POST">
    @csrf
    <label>姓名：
        <textarea name="name"></textarea>
    </label><br>
    <label>標題：
        <textarea name="title"></textarea>
    </label><br>
    <label>內容：
        <textarea name="content"></textarea>
    </label><br>
    <input type="submit" value="送出文章">
</form>