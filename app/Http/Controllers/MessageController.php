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
    public function index(Request $request)
    {
        $data = DB::table('messages')
                    ->where('deleted_at', '=', NULL)
                    ->orderBy('id', 'desc')
                    ->get()
                    ->toArray();
        // 當前頁面
        $pageNow = $request->get('page', 1);

        // 總留言數
        $totalDate = count($data);

        // 每頁顯示幾筆資料
        $pageLimit = 3;

        // 總頁數
        $totalPage = intval(ceil($totalDate / $pageLimit));

        // 計算起始資料
        $start = bcmul($pageLimit, bcsub($pageNow, 1));
        $messages = array_slice($data, $start, $pageLimit);

        return view('messages.index', [
            'messages' => $messages,
            'totalDate' => $totalDate,
            'pageNow' => $pageNow,
            'totalPage' => $totalPage]);
    }

    /**
     * 新增留言內容
     *
     * @param  \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:1|max:20',
            'content' => 'required|min:1|max:100',
            'avatar' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $newMessage = new Message;
        $newMessage->name = $request->input('name');
        $newMessage->content = $request->input('content');
        $newMessage->updated_at = null;

        // 加入大頭照
        if (trim($request->avatar)) {
            $avatar = $request->file('avatar');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            Image::make($avatar)->save(public_path('/uploads/avatars/' . $filename));

            $newMessage->avatar = $filename;
        } else {
            $avatar = url('uploads/avatars/default.jpg');
            $filename = time() . '.' . 'jpg';
            Image::make($avatar)->save(public_path('/uploads/avatars/' . $filename));

            $newMessage->avatar = $filename;
        }

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
        $this->validate($request, [
            'content' => 'required|min:1|max:100',
        ]);

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
