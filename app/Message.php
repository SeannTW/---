<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    /**
     * 資料表可輸入的屬性。
     *
     * @var array
     */
    protected $fillable = [
        'name', 'title', 'content'
    ];

    /**
     * Message表、Reply表 建立關聯。
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function replys()
    {
        return $this->hasMany(Reply::class, 'message_id');
    }
}
