<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Translatable\HasTranslations;

/**
 * Class Package
 * @package App\Models
 * @version April 11, 2022, 4:47 am UTC
 *
 * @property integer $provider_id
 * @property json $name
 * @property number $fees
 */
class Package extends Model
{
    use HasFactory, HasTranslations;

    public $table = 'packages';

    public $fillable = [
        'provider_id',
        'name',
        'description',
        'image',
        'fees',
        'destinations',
        'starting_city_id',
        'date_from',
        'time_from',
        'provider_notes',
        'provider_archive',
        'auto_approve',
        'additional'
    ];

    public $translatable = ['name', 'description'];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'provider_id' => 'integer',
        'name' => 'array',
        'description' => 'array',
        'image' => 'string',
        'fees' => 'double',
        'destinations' => 'array',
        'starting_city_id' => 'integer',
        'date_from' => 'string',
        'time_from' => 'string',
        'provider_notes' => 'string',
        'provider_archive' => 'boolean',
        'auto_approve' => 'boolean',
        'additional' => 'array',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        // 'provider_id' => 'required|exists:providers,id',
        'name' => 'required|array',
        'name.*' => 'required|string|max:255',
        'description' => 'nullable|array',
        'description.*' => 'nullable|string',
        'image' => 'required|image',
        'fees' => 'required|numeric|min:0',
        'destinations' => 'required|array',
        'destinations.*' => 'required|exists:destinations,id',
        'starting_city_id' => 'required|exists:cities,id',
        'date_from' => 'required|date_format:Y-m-d',
        'time_from' => 'required|date_format:H:i',
        'provider_notes' => 'nullable|string',
        'provider_archive' => 'nullable|boolean',
        'auto_approve' => 'nullable|boolean',
        'additional' => 'required|array',
        'additional.*' => 'required|array',
        'additional.*.id' => 'nullable|exists:additionals,id',
        'additional.*.fees' => 'nullable|required_with:additional.*.id|numeric|min:0',
    ];

    /**
     * Validation update rules
     *
     * @var array
     */
    public static $update_rules = [
        // 'provider_id' => 'required|exists:providers,id',
        'name' => 'required|array',
        'name.*' => 'required|string|max:255',
        'description' => 'nullable|array',
        'description.*' => 'nullable|string',
        'image' => 'nullable|image',
        'fees' => 'required|numeric|min:0',
        'destinations' => 'required|array',
        'destinations.*' => 'required|exists:destinations,id',
        'starting_city_id' => 'required|exists:cities,id',
        'date_from' => 'required|date_format:Y-m-d',
        'time_from' => 'required|date_format:H:i',
        'provider_notes' => 'nullable|string',
        'provider_archive' => 'nullable|boolean',
        'auto_approve' => 'nullable|boolean',
        'additional' => 'required|array',
        'additional.*' => 'required|array',
        'additional.*.id' => 'nullable|exists:additionals,id',
        'additional.*.fees' => 'nullable|required_with:additional.*.id|numeric|min:0',
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
    public function startingCity()
    {
        return $this->belongsTo(\App\Models\City::class, 'starting_city_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function packageDestinations()
    {
        return \App\Models\Destination::whereIn('id', $this->destinations)->get();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function additionals()
    {
        $additionals = [];
        foreach($this->additional ?? [] as $value) {
            $additional = \App\Models\Additional::find($value['id']);
            if(!is_null($additional)) $additionals[] = [
                'additional' => $additional,
                'fees' => $value['fees']];
        }

        return $additionals;
    }

    public function getAutoApproveSpanAttribute()
    {
        if($this->auto_approve) return '<span class="label label-success">'.__('msg.yes').'</span>';
        return '<span class="label label-primary">'.__('msg.no').'</span>';
    }
}
