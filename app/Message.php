<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends Model
{
    use SoftDeletes;

    /**
     * 資料表可輸入的屬性。
     *
     * @var array
     */
    protected $fillable = [
        'name', 'title', 'content', 'avatar'
    ];

    /**
     * Message表、Replies表 建立關聯。
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function replys()
    {
        return $this->hasMany(Replies::class, 'message_id');
    }
}
