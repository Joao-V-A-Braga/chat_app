<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'type',
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

    public function usersChats()
    {
        return $this->belongsTo(UsersChats::class);
    }
}
