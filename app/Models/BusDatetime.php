<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class BusOrder
 * @package App\Models
 * @version April 04, 2022, 11:42 am UTC
 *
 * @property integer $bus_id
 * @property integer $bus_order_id
 * @property string $date
 */
class BusDatetime extends Model
{
    use HasFactory;

    public $table = 'bus_datetimes';
    
    public $fillable = [
        'bus_id',
        'bus_order_id',
        'trip_id',
        'date',
        'time_from',
        'time_to'
    ];

    protected $appends = ['title'];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'bus_id' => 'integer',
        'bus_order_id' => 'integer',
        'trip_id' => 'integer',
        'date' => 'string',
        'time_from' => 'string',
        'time_to' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'bus_id' => 'required|exists:cities,id',
        'bus_order_id' => 'nullable|exists:bus_orders,id',
        'trip_id' => 'nullable|exists:trips,id',
        'date' => 'required|date_format:Y-m-d',
        'time_from' => 'required|date_format:H:i',
        'time_to' => 'required|date_format:H:i',
    ];

    /**
     * Validation update rules
     *
     * @var array
     */
    public static $update_rules = [
        'bus_id' => 'required|exists:cities,id',
        'bus_order_id' => 'nullable|exists:bus_orders,id',
        'trip_id' => 'nullable|exists:trips,id',
        'date' => 'required|date_format:Y-m-d',
        'time_from' => 'required|date_format:H:i',
        'time_to' => 'required|date_format:H:i',
    ];

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
    public function busOrder()
    {
        return $this->belongsTo(\App\Models\BusOrder::class, 'bus_order_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function trip()
    {
        return $this->belongsTo(\App\Models\Trip::class, 'trip_id');
    }

    public function getTitleAttribute()
    {
        if(!is_null($tripId = $this->trip_id)) {
            return __('models/trips.singular') . ' #' . $tripId;
        }
        if(!is_null($busOrderId = $this->bus_order_id)) {
            return __('models/busOrders.singular') . ' #' . $busOrderId;
        }
        return null;
    }
}
