<?php

namespace App\Models;

use App\Enums\LinkStatus;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['user_id', 'token', 'status', 'expires_at'])]
class UserLink extends Model
{

    protected $casts = [
        'status' => LinkStatus::class,
        'expires_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function scopeForUser($query, int $userId)
    {
        return $query->where('user_id', $userId)->latest();
    }

    public function scopeValidForUser($query, int $userId, string $token)
    {
        return $query->where('token', $token)
            ->where('user_id', $userId)
            ->where('expires_at', '>', now())
            ->where('status', LinkStatus::Active);
    }
}
