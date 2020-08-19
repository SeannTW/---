<?php

use App\Replies;
use App\Message;
use Illuminate\Database\Seeder;

class RepliesTableSeeder extends Seeder
{
    /**
     * replies資料表測試資料
     *
     * @return void
     */
    public function run()
    {
        $sunnyDay = Message::where('title', '晴天')->get('title');
        $cloudyDay = Message::where('title', '陰天')->get('title');
        $rainyDay = Message::where('title', '雨天')->get('title');

        $sunMessagesId = Message::where('title', '晴天')->get('id');
        $cloudyMessagesId = Message::where('title', '陰天')->get('id');
        $rainMessagesId = Message::where('title', '雨天')->get('id');

        $name = ['Aelx', 'Paul', 'Ella'];

        // 判斷標題內容為何種天氣
        if ($sunnyDay) {
            $a = [
                'content' => '是不是該出遊啦',
                'randMessage_id' => collect($sunMessagesId)->random()->id,
            ];
        }

        if ($cloudyDay) {
            $b = [
                'content' => '趕快回家',
                'randMessage_id' => collect($cloudyMessagesId)->random()->id,
            ];
        }

        if ($rainyDay) {
            $c = [
                'content' => '還好沒有變成落湯雞',
                'randMessage_id' => collect($rainMessagesId)->random()->id,
            ];
        }

        $e = [$a, $b, $c];
        $result = collect($e);

        for ($i = 0; $i < 3; $i ++) {
            $newContent = $result->random();
            $newName = $name[rand(0, 2)];

            $dateParam= rand(1596211200, 1598889599);
            $newDate = date("Y-m-d H:i:s", $dateParam);

            $replys = new Replies;

            $replys->name = $newName;
            $replys->content = $newContent['content'];
            $replys->message_id = $newContent['randMessage_id'];
            $replys->created_at = \Carbon\Carbon::parse($newDate)->timestamp;
            $replys->updated_at = \Carbon\Carbon::parse($newDate)->timestamp;
            $replys->save();
        }
    }
}
