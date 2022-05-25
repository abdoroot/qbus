<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Translatable\HasTranslations;

/**
 * Class Destination
 * @package App\Models
 * @version April 7, 2022, 8:32 am UTC
 *
 * @property string  $name
 * @property integer $provider_id
 * @property integer $from_city_id
 * @property integer $to_city_id
 * @property integer $starting_terminal_id
 * @property integer $arrival_terminal_id
 * @property array   $stops
 */
class Destination extends Model
{
    use HasFactory, HasTranslations;

    public $table = 'destinations';

    public $fillable = [
        'provider_id',
        'from_city_id',
        'to_city_id',
        'starting_terminal_id',
        'arrival_terminal_id',
        'stops'
    ];

    public $translatable = ['name'];
    protected $appends = ['name'];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'provider_id' => 'integer',
        'from_city_id' => 'integer',
        'to_city_id' => 'integer',
        'starting_terminal_id' => 'integer',
        'arrival_terminal_id' => 'integer',
        'stops' => 'array'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        // 'provider_id' => 'required|exists:providers,id',
        'from_city_id' => 'required|exists:cities,id',
        'to_city_id' => 'required|exists:cities,id',
        'starting_terminal_id' => 'required|exists:terminals,id',
        'arrival_terminal_id' => 'required|exists:terminals,id',
        'stops' => 'nullable|array',
        'stops.*' => 'required|exists:terminals,id',
    ];

    /**
     * Validation update rules
     *
     * @var array
     */
    public static $update_rules = [
        // 'provider_id' => 'required|exists:providers,id',
        'from_city_id' => 'required|exists:cities,id',
        'to_city_id' => 'required|exists:cities,id',
        'starting_terminal_id' => 'required|exists:terminals,id',
        'arrival_terminal_id' => 'required|exists:terminals,id',
        'stops' => 'nullable|array',
        'stops.*' => 'required|exists:terminals,id',
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
    public function fromCity()
    {
        return $this->belongsTo(\App\Models\City::class, 'from_city_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function toCity()
    {
        return $this->belongsTo(\App\Models\City::class, 'to_city_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function startingTerminal()
    {
        return $this->belongsTo(\App\Models\Terminal::class, 'starting_terminal_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function arrivalTerminal()
    {
        return $this->belongsTo(\App\Models\Terminal::class, 'arrival_terminal_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function stopTerminals()
    {
        return \App\Models\Terminal::whereIn('id', $this->stops ?? [])->get();
    }

    public function getNameAttribute()
    {
        return (!is_null($fromCity = $this->fromCity) ? $fromCity->name : '?') . ' - ' . 
            (!is_null($toCity = $this->toCity) ? $toCity->name : '?');
    }
}
