<?php

namespace App\Http\Controllers;

use DB;
use App\Message;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Intervention\Image\Facades\Image;

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
        if (trim($request->name) == '') {
            return new Response('No enter name');
        }

        if (trim($request->content) == '') {
            return new Response('No enter content');
        }

        // 加入大頭照
        $avatar = $request->file('avatar');
        $filename = time() . '.' . $avatar->getClientOriginalExtension();
        Image::make($avatar)->save(public_path('/uploads/avatars/' . $filename));

        $newMessage = new Message;
        $newMessage->name = $request->input('name');
        $newMessage->content = $request->input('content');
        $newMessage->updated_at = null;
        $newMessage->avatar = $filename;

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

        if (!$message) {
            return new Response('Not found message');
        }

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
        if (trim($request->content) == '') {
            return new Response('No enter content');
        }

        $updateMessage = Message::find($request->input('id'));

        if (!$updateMessage) {
            return new Response('Not found message');
        }

        $updateMessage->content = $request->input('content');
        $updateMessage->save();

        return redirect(route('messages.index'));
    }

    /**
     * 刪除單筆留言 & 如有回覆一併刪除
     *
     * @param  \App\Message
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $deleteMessage = Message::find($request->id);

        if (!$deleteMessage) {
            return new Response('Not found message');
        }

        DB::table('replies')->where('message_id', $request->id)->delete();

        $deleteMessage->delete();

        return redirect(route('messages.index'));
    }
}
