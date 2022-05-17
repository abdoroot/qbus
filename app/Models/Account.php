<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * Class Account
 * @package App\Models
 * @version March 22, 2022, 10:48 am UTC
 *
 * @property string $username
 * @property string $password
 * @property integer $provider_id
 * @property tinyInteger $active
 */
class Account extends Authenticatable
{
    use HasFactory, Notifiable;

    public $table = 'accounts';

    public $fillable = [
        'username',
        'password',
        'provider_id',
        'active',
        'email',
        'phone',
        'role',
        'remember_token'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'username' => 'string',
        'password' => 'string',
        'provider_id' => 'integer',
        'email' => 'string',
        'phone' => 'string',
        'role' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'username' => 'required|string|max:255|unique:accounts,username',
        'password' => 'required|string|min:8|max:255',
        'provider_id' => 'required|exists:providers,id',
        'active' => 'required|boolean',
        'email' => 'nullable|email|unique:accounts,email',
        'phone' => 'nullable|numeric|unique:accounts,phone',
        'role' => 'required|in:admin,driver',
    ];

    /**
     * Validation update rules
     *
     * @var array
     */
    public static $update_rules = [
        'username' => 'required|string|max:255|unique:accounts,username',
        'password' => 'nullable|string|min:8|max:255',
        'provider_id' => 'required|exists:providers,id',
        'active' => 'required|boolean',
        'email' => 'nullable|email|unique:accounts,email',
        'phone' => 'nullable|numeric|unique:accounts,phone',
        'role' => 'required|in:admin,driver',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function provider()
    {
        return $this->belongsTo(\App\Models\Provider::class, 'provider_id');
    }

    public function getActiveSpanAttribute()
    {
        if($this->active) return '<span class="label label-success">'.__('models/accounts.active').'</span>';
        return '<span class="label label-warning">'.__('models/accounts.inactive').'</span>';
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function buses()
    {
        return $this->hasMany(\App\Models\Bus::class, 'account_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function notifications()
    {
        return $this->hasMany(\App\Models\Notification::class, 'account_id');
    }

    public function getNotifications($read = -1, $skip = null, $limit = null)
    {
        $query = \App\Models\Notification::where('to', 'provider')
            ->where(function($query) {
                $query->where('provider_id', null)
                    ->orWhere(function($query2) {
                        $query2->where('provider_id', $this->provider_id)
                            ->where('account_id', null);
                    })
                    ->orWhere('account_id', $this->id);
            });

        if($read != -1) {
            $query->where('read_at', $read ? '!=' : '=', null);
        }

        if (!is_null($skip)) {
            $query->skip($skip);
        }

        if (!is_null($limit)) {
            $query->limit($limit);
        }

        return $query;
    }
}
