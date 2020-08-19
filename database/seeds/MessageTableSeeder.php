<?php

use Illuminate\Database\Seeder;

class MessageTableSeeder extends Seeder
{
    /**
     * Messages資料表測試資料
     *
     * @return void
     */
    public function run()
    {
        $name = ['Jhon', 'Ben', 'Jacke', 'Alen', 'Nick'];
        $title = ['晴天', '陰天', '雨天'];
        $content = ['今日天氣真好', '天氣不穩定', '還好我有帶著雨傘'];

        for ($i = 0; $i < 5; $i ++) {
            $param = rand(0, 2);
            $dateParam= rand(1596211200, 1598889599);

            $newName = $name[rand(0, 4)];
            $newTitle = $title[$param];
            $newContent = $content[$param];
            $newDateTime = date("Y-m-d H:i:s", $dateParam);

            $message = new App\Message;
            $message->name = $newName;
            $message->title = $newTitle;
            $message->content = $newContent;
            $message->created_at = \Carbon\Carbon::parse($newDateTime)->timestamp;
            $message->updated_at = \Carbon\Carbon::parse($newDateTime)->timestamp;
            $message->save();
        }
    }
}
