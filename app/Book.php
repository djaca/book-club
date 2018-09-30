<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $guarded = [];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @param $value
     *
     * @return string
     */
    public function getImgAttribute($value)
    {
        return $value ? asset($value) : 'https://via.placeholder.com/480x640';
    }
}
