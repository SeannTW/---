<?php

use Illuminate\Database\Seeder;
use Intervention\Image\Facades\Image;

class MessageTableSeeder extends Seeder
{
    /**
     * Messages資料表測試資料
     *
     * @return void
     */
    public function run()
    {
        $name = ['Jhon', 'Ryan', 'Jack', 'Ellen', 'Leanna'];
        $content = ['大晴天今日天氣真好!', '天氣不穩定', '還好我有帶著雨傘'];

        for ($i = 0; $i < 5; $i ++) {
            $param = rand(0, 2);
            $dateParam= rand(1596211200, 1598889599);

            $newName = $name[rand(0, 4)];
            $newContent = $content[$param];
            $newDateTime = date("Y-m-d H:i:s", $dateParam);

            $avatar = url('/uploads/avatars/default.jpg');
            $filename = time() . '.' . 'jpg';
            Image::make($avatar)->save(public_path('/uploads/avatars/' . $filename));

            $message = new App\Message;
            $message->name = $newName;
            $message->content = $newContent;
            $message->created_at = \Carbon\Carbon::parse($newDateTime)->timestamp;
            $message->updated_at = null;
            $message->avatar = $filename;
            $message->save();
        }
    }
}
