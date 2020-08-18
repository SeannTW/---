<?php

use App\Reply;
use Illuminate\Database\Seeder;

class ReplyTableSeeder extends Seeder
{
    /**
     * Replys資料表測試資料
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 5; $i ++) {
            $message_id = rand(1,10);

            $reply = new Reply;
            $reply->name = '測試名稱'.$i;
            $reply->content = '測試內容'.$i;
            $reply->message_id = $message_id;
            $reply->save();
        }
    }
}
