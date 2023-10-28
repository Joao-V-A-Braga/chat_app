<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsersChatsConfiguration extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'isSilenced',
        'backGroundImage',
        'isFixed'
    ];

    public function userChat()
    {
        return $this->belongsTo(UsersChats::class);
    }
}
