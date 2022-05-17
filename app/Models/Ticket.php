<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Ticket
 * @package App\Models
 * @version April 13, 2022, 4:53 am UTC
 *
 * @property \App\Models\TripOrder $tripOrder
 * @property integer $seat_num
 */
class Ticket extends Model
{
    use HasFactory;

    public $table = 'tickets';

    public $fillable = [
        'trip_order_id',
        'package_order_id',
        'seat_num'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'trip_order_id' => 'integer',
        'package_order_id' => 'integer',
        'seat_num' => 'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'trip_order_id' => 'nullable|required_if:type,trip|exists:trip_orders,id',
        'package_order_id' => 'nullable|required_if:type,package|exists:package_orders,id'
    ];

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
}
