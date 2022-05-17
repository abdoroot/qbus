<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Contact
 * @package App\Models
 * @version March 21, 2022, 6:22 am UTC
 *
 * @property string $name
 * @property string $email
 * @property string $type
 * @property string $subject
 * @property string $message
 * @property string $read_at
 * @property string $reply_message
 */
class Contact extends Model
{
    use HasFactory;

    public $table = 'contacts';
    
    public $fillable = [
        'name',
        'email',
        'type',
        'subject',
        'message',
        'read_at',
        'reply_message',
        'user_id',
        'account_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'email' => 'string',
        'type' => 'string',
        'subject' => 'string',
        'message' => 'string',
        'reply_message' => 'string',
        'user_id' => 'integer',
        'account_id' =>'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|string|max:255|email',
        'type' => 'nullable|string|in:contact,complaint,enquiry,suggestion,help,feedback',
        'subject' => 'required|string|max:255',
        'message' => 'required|string',
        'read_at' => 'nullable|date_format:Y-m-d',
        'reply_message' => 'nullable|string',
        'user_id' => 'nullable|exists:users,id',
        'account_id' => 'nullable|exists:accounts,id',
    ];

    /**
     * Validation update rules
     *
     * @var array
     */
    public static $update_rules = [
        'type' => 'nullable|string|in:contact,complaint,enquiry,suggestion,help,feedback',
        'reply_message' => 'nullable|string'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function account()
    {
        return $this->belongsTo(\App\Models\Account::class, 'account_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function provider()
    {
        if(!is_null($this->account)) {
            return \App\Models\Provider::find($account->provider_id);
        }

        return null;
    }

    public function getProviderIdAttribute()
    {
        if(!is_null($this->account)) {
            return $account->provider_id;
        }

        return null;
    }
}
