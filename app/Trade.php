<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trade extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['offered_book_id', 'requested_book_id'];

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['requestedBook', 'offeredBook', 'requestedBook.user', 'offeredBook.user'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function requestedBook()
    {
        return $this->belongsTo(Book::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function offeredBook()
    {
        return $this->belongsTo(Book::class);
    }

    /**
     * @param $query
     *
     * @return mixed
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }
}
