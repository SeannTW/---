<?php

namespace App\Http\Controllers;

use App\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * 顯示所有留言
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $messages = Message::all();
        return view('messages.index', ['messages' => $messages]);
    }

    /**
     * 新增留言頁面
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('messages.create');
    }

    /**
     * 新增留言內容
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $message = new Message;
        $message->name = $request->input('name');
        $message->title = $request->input('title');
        $message->content = $request->input('content');
        $message->save();

        return redirect(route('posts.index'));
    }

    /**
     * 顯示單筆留言
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function show(Message $message)
    {
        return view('messages.show', ['message' => $message]);
    }

    /**
     * 編輯單筆留言
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function edit(Message $message)
    {
        return view('messages.edit', ['message' => $message]);
    }

    /**
     * 更新單筆留言
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Message $message)
    {
        $message->name = $request->input('name');
        $message->title = $request->input('title');
        $message->content = $request->input('content');
        $message->save();

        return redirect(route('messages.show', ['message' => $message]));
    }

    /**
     * 刪除單筆留言
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function destroy(Message $message)
    {
        $message->delete();

        return redirect(route('messages.index'));
    }
}
