<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class Admin
 * @package App\Models
 * @version March 14, 2022, 5:38 am UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection $adminPermissions
 * @property \Illuminate\Database\Eloquent\Collection $adminRoles
 * @property string $name
 * @property string $email
 * @property string $password
 * @property boolean $active
 * @property string $remember_token
 */
class Admin extends Authenticatable
{
    use HasFactory, Notifiable;

    public $table = 'admins';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    public $fillable = [
        'name',
        'email',
        'password',
        'active',
        'remember_token'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'email' => 'string',
        'password' => 'string',
        'active' => 'boolean',
        'remember_token' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|string|max:255|email|unique:admins,email',
        'password' => 'required|string|min:8|max:255',
        'active' => 'nullable|boolean'
    ];

    /**
     * Validation update rules
     *
     * @var array
     */
    public static $update_rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|string|max:255|email|unique:admins,email',
        'password' => 'nullable|string|min:8|max:255',
        'active' => 'nullable|boolean'
    ];

    public function getActiveSpanAttribute()
    {
        if($this->active) return '<span class="label label-success">'.__('msg.active').'</span>';
        return '<span class="label label-danger">'.__('msg.inactive').'</span>';
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function notifications()
    {
        return $this->hasMany(\App\Models\Notification::class, 'admin_id');
    }

    public function getNotifications($read = -1, $skip = null, $limit = null)
    {
        $query = \App\Models\Notification::where('to', 'admin')
            ->where(function($query) {
                $query->where('admin_id', null)
                      ->orWhere('admin_id', $this->id);
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

        $query->orderBy('id', 'desc');

        return $query;
    }
}
