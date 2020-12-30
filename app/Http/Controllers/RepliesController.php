<?php

namespace App\Http\Controllers;

use DB;
use App\Replies;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RepliesController extends Controller
{
    /**
     * 顯示該留言的全部回覆內容
     *
     * @param  string $id 單筆留言id
     * @return object $replies 單筆回覆內容
     * @return object $message 單筆留言內容
     * @return int $totalReplies 總回覆數量 
     */
    public function index($id)
    {
        $message = DB::table('messages')->find($id);

        if (!$message) {
            return new Response('Not found message');
        }

        $replies = DB::table('replies')->where('message_id', $id)->where('deleted_at', null)->get();
        $totalReplies = count($replies);

        return view('replies.index', ['replies' => $replies, 'message' => $message, 'total' => $totalReplies]);
    }

    /**
     * 新增回覆內容
     *
     * @param  Request $request 新增回覆內容
     * @return void
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:1|max:20',
            'content' => 'required|min:1|max:100',
        ]);

        $newReplies = new Replies;
        $newReplies->name = $request->input('name');
        $newReplies->content = $request->input('content');
        $newReplies->message_id = $request->input('messageId');
        $newReplies->updated_at = null;
        $newReplies->save();

        return redirect()->back();
    }

    /**
     * 編輯單筆回覆頁面
     *
     * @param  string $replies 單筆回覆id
     * @return object $resultResult 單筆回覆內容
     * @return object $resultMessage 單筆留言內容
     */
    public function edit($replies)
    {
        $editReplies = DB::table('replies')
                            ->where('id', $replies)
                            ->get()
                            ->toArray();

        if (!$editReplies) {
            return new Response('Not found replies');
        }

        $resultResult = $editReplies['0'];
        $resultMessage = DB::table('messages')->find($resultResult->message_id);

        if (!$resultMessage) {
            return new Response('Not found message');
        }

        return view('replies.edit', ['replies' => $resultResult, 'message' => $resultMessage]);
    }

    /**
     * 更新單筆回覆內容
     *
     * @param  request $request 更新回覆內容
     * @return int $updateReplies->message_id 單筆留言id
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'content' => 'required|min:1|max:100',
        ]);

        $updateReplies = Replies::find($request->id);

        if (!$updateReplies) {
            return new Response('Not found replies');
        }

        $updateReplies->content = $request->input('content');
        $updateReplies->save();

        return redirect(route('replies.index', ['id' => $updateReplies->message_id]));
    }

    /**
     * 刪除單筆回覆
     *
     * @param  request $request 刪除回覆內容
     * @return void
     */
    public function destroy(Request $request)
    {
        $deleteReplies = Replies::find($request->id);

        if (!$deleteReplies) {
            return new Response('Not found replies');
        }

        $deleteReplies->delete();

        return redirect()->back();
    }
}
