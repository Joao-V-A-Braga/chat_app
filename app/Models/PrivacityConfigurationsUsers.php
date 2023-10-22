<?php

namespace App\Models;

use App\Models\ConfigurationsUser;
use Illuminate\Database\Eloquent\Model;

class PrivacityConfigurationsUsers extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'configuration_user_id',
        'is_read_confirmation',
        'last_seen_type',
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        if (!$this->configuration_user_id) {
            $configurationUser = (!empty($attributes)) ? new ConfigurationsUser(['type' => 'PRIVACITY', 'user' => $attributes['user']]) : null;

            if ($configurationUser) {
                $configurationUser->save();
                $this->configuration_user_id = $configurationUser->id;
            }
        }
    }

    public function configurationUser()
    {
        return $this->hasOne(ConfigurationsUser::class, 'id', 'configuration_user_id');
    }
}
