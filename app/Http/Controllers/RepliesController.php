<?php

namespace App\Http\Controllers;

use DB;
use App\Replies;
use Illuminate\Http\Request;

class RepliesController extends Controller
{
    /**
     * 顯示該留言的回覆頁面
     *
     * @param  \App\Replies
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $message = DB::table('messages')->find($id);
        $replies = DB::table('replies')->where('message_id', $id)->get();

        return view('replies.index', ['replies' => $replies, 'message' => $message]);
    }

    /**
     * 新增回覆內容
     *
     * @param  \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $newReplies = new Replies;
        $newReplies->name = $request->input('name');
        $newReplies->content = $request->input('content');
        $newReplies->message_id = $request->input('messageId');
        $newReplies->save();

        return redirect()->back();
    }

    /**
     * 編輯單筆回覆頁面
     *
     * @param  \App\Replies
     * @return \Illuminate\Http\Response
     */
    public function edit($replies)
    {
        $editReplies = DB::table('replies')
                    ->where('id', $replies)
                    ->get()
                    ->toArray();
        $resultResult = $editReplies['0'];
        $resultMessage = DB::table('messages')->find($resultResult->message_id);

        return view('replies.edit', ['replies' => $resultResult, 'message' => $resultMessage]);
    }

    /**
     * 更新單筆回覆內容
     *
     * @param  \Illuminate\Http\Request
     * @param  \App\Replies
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $updateReplies = Replies::find($request->id);
        $updateReplies->content = $request->input('content');
        $updateReplies->save();

        return redirect(route('replies.index', ['id' => $updateReplies->message_id]));
    }

    /**
     * 刪除單筆回覆
     *
     * @param  \App\Replies
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $deleteReplies = Replies::find($request->id);
        $deleteReplies->delete();

        return redirect(route('replies.index', ['id' => $deleteReplies->message_id]));
    }
}
