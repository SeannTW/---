<?php

namespace App\Http\Controllers;

use App\Replies;
use App\Messasge;
use DB;
use Illuminate\Http\Request;

class RepliesController extends Controller
{
    /**
     * 顯示該留言的回覆頁面
     *
     * @param  \App\Replies  $replies
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $message = DB::table('messages')->find($id);
        $replies = DB::table('replies')
                ->where('message_id', $id)
                ->get();
        //dd($replies);
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
        $replies = new Replies;
        //$id = $request->input('id');
        $replies->name = $request->input('name');
        $replies->content = $request->input('content');
        $replies->message_id = $request->input('messageId');
        $replies->save();

        return redirect()->back();
    }

    /**
     * 編輯單筆回覆頁面
     *
     * @param  \App\Replies  $replies
     * @return \Illuminate\Http\Response
     */
    public function edit($replies)
    {
        $replies = DB::table('replies')
                ->where('id', $replies)
                ->get();

        $editReplies = $replies->toArray();
        $resultResult = $editReplies['0'];
        //dd($result);
        $resultMessage = DB::table('messages')->find($resultResult->message_id);
        //dd($message);
        return view('replies.edit', ['replies' => $resultResult, 'message' => $resultMessage]);
    }

    /**
     * 更新單筆回覆
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Replies  $replies
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $replies = Replies::find($request->id);
        // dd($replies);
        $replies->content = $request->input('content');
        $replies->save();

        // return redirect()->back();
        return redirect(route('replies.index', ['id' => $replies->message_id]));
    }

    /**
     * 刪除單筆回覆
     *
     * @param  \App\Replies  $replies
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $deleteReplies = Replies::find($request->id);
        $deleteReplies->delete();

        return redirect(route('replies.index', ['id' => $deleteReplies->message_id]));
    }
}
