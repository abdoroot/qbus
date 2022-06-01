<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class BusOrder
 * @package App\Models
 * @version March 28, 2022, 8:42 am UTC
 *
 * @property string $date
 * @property string $time
 * @property string $lat
 * @property string $lng
 * @property integer $zoom
 * @property integer $user_id
 * @property integer $provider_id
 * @property integer $bus_id
 * @property number $fees
 * @property string $status
 */
class BusOrder extends Model
{
    use HasFactory;

    public $table = 'bus_orders';
    
    public $fillable = [
        'lat',
        'lng',
        'zoom',
        'date_from',
        'time_from',
        'date_to',
        'time_to',
        'user_id',
        'provider_id',
        'bus_id',
        'fees',
        'status',
        'user_notes',
        'provider_notes',
        'user_archive',
        'provider_archive',
        'destination',
        'tax',
        'total',
        'admin_notes'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'date_from' => 'string',
        'time_from' => 'string',
        'date_to' => 'string',
        'time_to' => 'string',
        'lat' => 'string',
        'lng' => 'string',
        'zoom' => 'integer',
        'user_id' => 'integer',
        'provider_id' => 'integer',
        'bus_id' => 'integer',
        'fees' => 'double',
        'status' => 'string',
        'user_notes' => 'string',
        'provider_notes' => 'string',
        'user_archive' => 'boolean',
        'provider_archive' => 'boolean',
        'destination' => 'array',
        'tax' => 'double',
        'total' => 'double',
        'admin_notes' => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'lat' => 'required|numeric',
        'lng' => 'required|numeric',
        'zoom' => 'required|integer',
        'date_from' => 'required|date_format:Y-m-d',
        'time_from' => 'required|date_format:H:i',
        'date_to' => 'required|date_format:Y-m-d|after_or_equal:date_from',
        'time_to' => 'required|date_format:H:i|after:time_from',
        // 'user_id' => 'required|exists:users,id',
        'provider_id' => 'required|exists:providers,id',
        'bus_id' => 'required|exists:buses,id',
        // 'fees' => 'nullable|numeric|min:0',
        // 'status' => 'nullable|in:pending,canceled,approved,rejected,paid,complete',
        'user_notes' => 'nullable|string|required_if:status,canceled',
        // 'provider_notes' => 'nullable|string|required_if:status,rejected',
        // 'user_archive' => 'nullable|boolean',
        // 'provider_archive' => 'nullable|boolean',
        'destination' => 'required|array|min:2',
        'destination.*' => 'required|exists:cities,id',
    ];

    /**
     * Validation rules from provider side.
     *
     * @var array
     */
    public static $provider_rules = [
        'lat' => 'required|numeric',
        'lng' => 'required|numeric',
        'zoom' => 'required|integer',
        'date_from' => 'required|date_format:Y-m-d',
        'time_from' => 'required|date_format:H:i',
        'date_to' => 'required|date_format:Y-m-d|after_or_equal:date_from',
        'time_to' => 'required|date_format:H:i|after:time_from',
        'user_id' => 'required|exists:users,id',
        'bus_id' => 'required|exists:buses,id',
        'fees' => 'nullable|required_if:status,approved|numeric|min:0',
        'status' => 'nullable|in:pending,approved',
        'user_notes' => 'nullable|string|required_if:status,canceled',
        'provider_notes' => 'nullable|string|required_if:status,rejected',
        'destination' => 'required|array|min:2',
        'destination.*' => 'required|exists:cities,id',
    ];

    /**
     * Validation update rules
     *
     * @var array
     */
    public static $update_rules = [
        'status' => 'nullable|in:pending,approved,rejected',
        'provider_notes' => 'nullable|string|required_if:status,rejected',
        'fees' => 'nullable|required_if:status,approved|numeric|min:0',

    ];
    /**
     * Validation admin rules
     *
     * @var array
     */
    public static $admin_rules = [
        'admin_notes' => 'required|string',
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
    public function provider()
    {
        return $this->belongsTo(\App\Models\Provider::class, 'provider_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function bus()
    {
        return $this->belongsTo(\App\Models\Bus::class, 'bus_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function destinationCities()
    {
        $cities = [];
        foreach($this->destination ?? [] as $city_id) {
            $city = \App\Models\City::find($city_id);
            if(!is_null($city)) $cities[] = $city;
        }

        return $cities;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function datetimes()
    {
        return $this->hasMany(\App\Models\BusDatetime::class, 'bus_order_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     **/
    public function review()
    {
        return $this->hasOne(\App\Models\Review::class, 'bus_order_id');
    }
    
    public function getStatusColorAttribute()
    {
        switch ($this->status) {
            case 'pending':
                return 'warning';
                break;

            case 'canceled':
                return 'default';
                break;

            case 'approved':
                return 'info';
                break;
            
            case 'rejected':
                return 'danger';
                break;

            case 'paid':
                return 'primary';
                break;

            case 'complete':
                return 'success';
                break;

            default:
                return 'secondary';
                break;
        }
    }

    public function getStatusSpanAttribute()
    {
        $color = $this->status_color;
        $color = ($color == 'default' ? 'inverse' : $color);
        return "<span class='label label-{$color}'>{$this->status}</span>";
    }
}
