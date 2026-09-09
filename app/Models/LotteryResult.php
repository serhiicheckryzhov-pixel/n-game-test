<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LotteryResult extends Model
{
    protected $fillable = [
        'user_id',
        'user_link_id',
        'income',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function userLink(): BelongsTo
    {
        return $this->belongsTo(UserLink::class, 'user_link_id');
    }
}
