<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConfigurationsUser extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'type',
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        if (!empty($attributes)) {
            $this->type = $attributes['type'];
            $this->user_id = $attributes['user']->id;
        }
    }

    public function configuration()
    {
        if ($this->type == 'PRIVACITY')
            return $this->belongsTo(PrivacityConfigurationsUsers::class, 'configurations_users_id');
        else
            return null;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
