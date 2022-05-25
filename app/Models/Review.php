<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Review
 * @package App\Models
 * @version April 14, 2022, 4:53 am UTC
 */
class Review extends Model
{
    use HasFactory;

    public $table = 'reviews';

    public $fillable = [
        'trip_id',
        'package_id',
        'user_id',
        'bus_order_id',
        'provider_id',
        'name',
        'email',
        'rate',
        'review',
        'publish'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'trip_id' => 'integer',
        'package_id' => 'integer',
        'user_id' => 'integer',
        'bus_order_id' => 'integer',
        'provider_id' => 'integer',
        'name' => 'string',
        'email' => 'string',
        'rate' => 'integer',
        'review' => 'string',
        'publish' => 'boolean',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'trip_id' => 'nullable|exists:trips,id',
        'package_id' => 'nullable|exists:packages,id',
        'bus_order_id' => 'nullable|exists:bus_orders,id',
        'user_id' => 'nullable|exists:users,id',
        'provider_id' => 'nullable|exists:providers,id',
        'name' => 'required|string|max:255',
        'email' => 'required|string|max:255|email',
        'rate' => 'required|integer|min:1|max:5',
        'review' => 'required|string',
    ];

    /**
     * Validation update rules
     *
     * @var array
     */
    public static $update_rules = [
        'publish' => 'nullable|boolean'
    ];

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
    public function busOrder()
    {
        return $this->belongsTo(\App\Models\BusOrder::class, 'busOrder_id');
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
    public function provider()
    {
        return $this->belongsTo(\App\Models\Provider::class, 'provider_id');
    }

    public function getPublishSpanAttribute()
    {
        if($this->publish) return '<span class="label label-success">'.__('msg.yes').'</span>';
        return '<span class="label label-primary">'.__('msg.no').'</span>';
    }
}
