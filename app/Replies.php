<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class replies extends Model
{
    /**
     * 資料表可輸入的屬性。
     *
     * @var array
     */
    protected $fillable = [
        'name', 'content'
    ];

    /**
     * replies表、Message表 建立關聯。
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function message()
    {
        return $this->belongsTo(Message::class);
    }
}
