<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsersChats extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'users_chats_configuration_id',
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

    public function chat()
    {
        return $this->hasOne(Chat::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function configuration()
    {
        return $this->belongsTo(UsersChatsConfiguration::class, 'users_chats_configuration_id');
    }
}
