<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ChatInvitation extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'chat_id',
        'active',
        'expiration',
        'link',
        'destiny',
        'sender'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'expiration' => 'datetime',
    ];

    public function chat()
    {
        return $this->belongsTo(Chat::class);
    }

    public function destinyUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'destiny', 'id');
    }

    public function senderUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'sender', 'id');
    }
}
