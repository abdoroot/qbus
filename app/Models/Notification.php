<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Notification
 * @package App\Models
 * @version March 15, 2022, 8:50 am UTC
 *
 * @property string $title
 * @property string $text
 * @property string $url
 * @property string $icon
 * @property string $type
 * @property string $to
 * @property unsignedBigInteger $admin_id
 * @property unsignedBigInteger $user_id
 * @property string $read_at
 */
class Notification extends Model
{
    use HasFactory;

    public $table = 'notifications';
    
    public $fillable = [
        'title',
        'text',
        'url',
        'icon',
        'type',
        'to',
        'admin_id',
        'user_id',
        'provider_id',
        'account_id',
        'read_at'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'title' => 'string',
        'text' => 'string',
        'url' => 'string',
        'icon' => 'string',
        'type' => 'string',
        'to' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'title' => 'required|string|max:255',
        'text' => 'required|string',
        'url' => 'nullable|string|max:255|url',
        'icon' => 'nullable|image',
        'type' => 'required|in:primary,info,success,warning,danger',
        'to' => 'required|in:user,provider,admin',
        'admins' => 'nullable|required_if:to,admin|array|min:1',
        'admins.*' => 'exists:admins,id',
        'users' => 'nullable|required_if:to,user|array|min:1',
        'users.*' => 'exists:users,id',
        'providers' => 'nullable|required_if:to,provider|array|min:1',
        'providers.*' => 'exists:providers,id',
        'accounts' => 'nullable|array|min:1',
        'accounts.*' => 'exists:accounts,id',
        // 'admin_id' => 'nullable|exists:admins,id',
        // 'user_id' => 'nullable|exists:users,id',
        // 'read_at' => 'nullable|date_format:Y-m-d'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function admin()
    {
        return $this->belongsTo(\App\Models\Admin::class, 'admin_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function user()
    {
        return $this->belongsTo(\App\Models\user::class, 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function provider()
    {
        return $this->belongsTo(\App\Models\Provider::class, 'provider_id');
    }
}
