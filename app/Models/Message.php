<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Eloquent as Model;

/**
 * Class Message
 * @package App\Models
 * @version March 22, 2022, 10:48 am UTC
 */
class Message extends Model
{
    use HasFactory;

    public $table = 'messages';

    public $fillable = [
        'chat_id',
        'sender',
        'message',
        'read_at'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'chat_id' => 'integer',
        'sender' => 'string',
        'message' => 'string',
        'read_at' => 'datetime:Y-m-d H:i:s'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'chat_id' => 'required|exists:chats,id',
        'sender' => 'nullable|in:user,provider',
        'message' => 'required|string',
        'read_at' => 'nullable|date_format:Y-m-d H:i:s',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function chat()
    {
        return $this->belongsTo(\App\Models\Chat::class, 'chat_id');
    }
}
