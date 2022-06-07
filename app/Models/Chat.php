<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Eloquent as Model;

/**
 * Class Chat
 * @package App\Models
 * @version March 22, 2022, 10:48 am UTC
 */
class Chat extends Model
{
    use HasFactory;

    public $table = 'chats';

    public $fillable = [
        'provider_id',
        'user_id',
        'trip_id',
        'package_id',
        'bus_id',
        'trip_order_id',
        'package_order_id',
        'bus_order_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'provider_id' => 'integer',
        'user_id' => 'integer',
        'trip_id' => 'integer',
        'package_id' => 'integer',
        'bus_id' => 'integer',
        'trip_order_id' => 'integer',
        'package_order_id' => 'integer',
        'bus_order_id' => 'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'provider_id' => 'required|exists:providers,id',
        'user_id' => 'nullable|exists:users,id',
        'trip_id' => 'nullable|exists:trips,id',
        'package_id' => 'nullable|exists:packages,id',
        'bus_id' => 'nullable|exists:buses,id',
        'trip_order_id' => 'nullable|exists:trip_orders,id',
        'package_order_id' => 'nullable|exists:package_orders,id',
        'bus_order_id' => 'nullable|exists:bus_orders,id',
        'message' => 'required|string',
        'chat_id' => 'nullable|exists:chats,id',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function provider()
    {
        return $this->belongsTo(\App\Models\Provider::class, 'provider_id');
    }

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
    public function trip()
    {
        return $this->belongsTo(\App\Models\Trip::class, 'trip_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function package()
    {
        return $this->belongsTo(\App\Models\Package::class, 'package_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function bus()
    {
        return $this->belongsTo(\App\Models\Bus::class, 'bus_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function tripOrder()
    {
        return $this->belongsTo(\App\Models\TripOrder::class, 'trip_order_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function packageOrder()
    {
        return $this->belongsTo(\App\Models\PackageOrder::class, 'package_order_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function busOrder()
    {
        return $this->belongsTo(\App\Models\BusOrder::class, 'bus_order_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function messages()
    {
        return $this->hasMany(\App\Models\Message::class, 'chat_id');
    }

    public function getMessages($read = -1, $skip = null, $limit = null)
    {
        $query = new \App\Models\Message;

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

    public function getLastMessageAttribute()
    {
        $message = \App\Models\Message::where('chat_id', $this->id)->orderBy('id', 'desc')->first();
        if(!is_null($message)) {
            $sender = __('msg.you');
            if($message->sender == 'provider' && !is_null($this->provider)) {
                $sender = $this->provider->name;
            }
            return "<h1 class='text-lg font-medium'>".$sender."</h1><p class='px-3'>".substr($message->message, 0, 100)."</p>";
        }
        return null;
    }
}
