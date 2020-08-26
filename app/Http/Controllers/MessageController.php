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
     * 新增留言內容
     *
     * @param  \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $newMessage = new Message;
        $newMessage->name = $request->input('name');
        $newMessage->content = $request->input('content');
        $newMessage->save();

        return redirect(route('messages.index'));
    }

    /**
     * 編輯單筆留言頁面
     *
     * @param  \App\Message
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $message = Message::find($id);
        return view('messages.edit', ['message' => $message]);
    }

    /**
     * 更新單筆留言內容
     *
     * @param  \Illuminate\Http\Request
     * @param  \App\Message
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $updateMessage = Message::find($request->input('id'));
        $updateMessage->content = $request->input('content');
        $updateMessage->save();

        return redirect(route('messages.index'));
    }

    /**
     * 刪除單筆留言
     *
     * @param  \App\Message
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        $deleteMessage = Message::find($id);
        $deleteMessage->delete();

        return redirect(route('messages.index'));
    }
}
