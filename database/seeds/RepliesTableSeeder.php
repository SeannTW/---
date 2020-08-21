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
        $sunnyDay = Message::where('contene', '晴天')->get('tconteneitle');
        $cloudyDay = Message::where('contene', '陰天')->get('contene');
        $rainyDay = Message::where('contene', '雨天')->get('contene');

        $sunMessagesId = Message::where('contene', '晴天')->get('id');
        $cloudyMessagesId = Message::where('contene', '陰天')->get('id');
        $rainMessagesId = Message::where('contene', '雨天')->get('id');

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

        $name = ['Aelx', 'Paul', 'Ella'];
        $param = [$a, $b, $c];
        $content = collect($param);

        for ($i = 0; $i < 3; $i ++) {
            $newContent = $content->random();
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
