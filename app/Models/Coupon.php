<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Coupon
 * @package App\Models
 * @version April 26, 2022, 9:47 pm UTC
 *
 * @property integer $provider_id
 * @property string $name
 * @property string $date_from
 * @property string $date_to
 * @property string $type
 * @property number $discount
 * @property string $code
 */
class Coupon extends Model
{
    use HasFactory;

    public $table = 'coupons';

    public $fillable = [
        'provider_id',
        'name',
        'date_from',
        'date_to',
        'type',
        'discount',
        'code',
        'status',
        'admin_notes'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'provider_id' => 'integer',
        'name' => 'string',
        'date_from' => 'string',
        'date_to' => 'string',
        'type' => 'string',
        'discount' => 'double',
        'code' => 'string',
        'status' => 'string',
        'admin_notes' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|string|max:255',
        'date_from' => 'required|date_format:Y-m-d',
        'date_to' => 'required|date_format:Y-m-d|after:date_from',
        'type' => 'required|in:amount,percentage',
        'discount' => 'required|numeric|min:0'
    ];

    /**
     * Validation update rules
     *
     * @var array
     */
    public static $update_rules = [
        'status' => 'nullable|in:pending,approved,rejected',
        'admin_notes' => 'nullable|required_if:status,rejected|string'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function provider()
    {
        return $this->belongsTo(\App\Models\Provider::class, 'provider_id');
    }public function getStatusColorAttribute()
    {
        switch ($this->status) {
            case 'pending':
                return 'warning';
                break;

            case 'approved':
                return 'success';
                break;
            
            case 'rejected':
                return 'danger';
                break;

            default:
                return 'secondary';
                break;
        }
    }

    public function getStatusSpanAttribute()
    {
        return "<span class='label label-{$this->status_color}'>{$this->status}</span>";
    }
}
