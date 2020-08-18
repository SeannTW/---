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
        foreach(range(1, 10) as $number) {
            App\Message::create([
                'name' => '測試名稱'.$number,
                'title' => '測試標題'.$number,
                'content' => '測試內容'.$number,
            ]);
        }
    }
}
