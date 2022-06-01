<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Bus
 * @package App\Models
 * @version March 24, 2022, 12:51 am UTC
 *
 * @property string $plate
 * @property string $image
 * @property integer $passengers
 * @property number $fees
 * @property integer $account_id
 * @property integer $provider_id
 */
class Bus extends Model
{
    use HasFactory;

    public $table = 'buses';
    
    public $fillable = [
        'plate',
        'image',
        'passengers',
        'account_id',
        'provider_id',
        'active',
        'rate'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'plate' => 'string',
        'image' => 'string',
        'passengers' => 'integer',
        'account_id' => 'integer',
        'provider_id' => 'integer',
        'active' => 'boolean',
        'rate' => 'double'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'plate' => 'required|string|unique:buses,plate',
        'image' => 'required|image',
        'passengers' => 'required|integer',
        'account_id' => 'required|exists:accounts,id',
        // 'provider_id' => 'required|exists:providers,id',
        'active' => 'required|boolean',
    ];

    /**
     * Validation update rules
     *
     * @var array
     */
    public static $update_rules = [
        'plate' => 'required|string|unique:buses,plate',
        'image' => 'nullable|image',
        'passengers' => 'required|integer',
        'account_id' => 'required|exists:accounts,id',
        'active' => 'required|boolean',
    ];

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
        return $this->belongsTo(\App\Models\Provider::class, 'provider_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function busDatetimes()
    {
        return $this->hasMany(\App\Models\BusDatetime::class, 'bus_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function busOrders()
    {
        return $this->hasMany(\App\Models\BusOrder::class, 'bus_id');
    }

    public function getActiveSpanAttribute()
    {
        if($this->active) return '<span class="label label-success">'.__('msg.active').'</span>';
        return '<span class="label label-warning">'.__('msg.inactive').'</span>';
    }
}
