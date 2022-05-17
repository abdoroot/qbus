<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class TripOrder
 * @package App\Models
 * @version April 13, 2022, 4:53 am UTC
 *
 * @property \App\Models\Trip $trip
 * @property \App\Models\User $user
 * @property integer $trip_id
 * @property integer $user_id
 * @property integer $provider_id
 * @property integer $count
 * @property number $total
 * @property string $status
 * @property string $user_notes
 * @property string $provider_notes
 * @property boolean $user_archive
 * @property boolean $provider_archive
 */
class TripOrder extends Model
{
    use HasFactory;

    public $table = 'trip_orders';

    public $fillable = [
        'trip_id',
        'user_id',
        'provider_id',
        'count',
        'total',
        'status',
        'user_notes',
        'provider_notes',
        'user_archive',
        'provider_archive',
        'fees',
        'tax',
        'coupon_id',
        'type',
        'admin_notes'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'trip_id' => 'integer',
        'user_id' => 'integer',
        'provider_id' => 'integer',
        'count' => 'integer',
        'total' => 'float',
        'status' => 'string',
        'user_notes' => 'string',
        'provider_notes' => 'string',
        'user_archive' => 'boolean',
        'provider_archive' => 'boolean',
        'fees' => 'double',
        'tax' => 'double',
        'coupon_id' => 'integer',
        'type' => 'string',
        'admin_notes' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'trip_id' => 'required|exists:trips,id',
        'count' => 'required|integer',
        'user_notes' => 'nullable|string',
        'code' => 'nullable|exists:coupons,code',
        'type' => 'required|string|in:one-way,round,multi',
    ];

    /**
     * Validation rules from provider side.
     *
     * @var array
     */
    public static $provider_rules = [
        'trip_id' => 'required|exists:trips,id',
        'user_id' => 'required|exists:users,id',
        'count' => 'required|integer',
        'user_notes' => 'nullable|string',
        'coupon_id' => 'nullable|exists:coupons,id',
        'type' => 'required|string|in:one-way,round,multi',
    ];

    /**
     * Validation update rules
     *
     * @var array
     */
    public static $update_rules = [
        'status' => 'nullable|in:pending,approved,rejected',
        'provider_notes' => 'nullable|string|required_if:status,rejected',
        // 'return' => 'nullable|required_if:status,rejected|in:bank,wallet',
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
    public function trip()
    {
        return $this->belongsTo(\App\Models\Trip::class, 'trip_id');
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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function coupon()
    {
        return $this->belongsTo(\App\Models\Coupon::class, 'coupon_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function tickets()
    {
        return $this->hasMany(\App\Models\Ticket::class, 'trip_order_id');
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

    public function getDiscountAttribute()
    {
        if(is_null($coupon = $this->coupon)) return null;
        $subtotal = $this->fees + $this->tax;
        if($coupon->type == 'discount') return $coupon->discount;
        return $subtotal * $coupon->discount / 100;
    }
}
