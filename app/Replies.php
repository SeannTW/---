<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class replies extends Model
{
    use SoftDeletes;

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
