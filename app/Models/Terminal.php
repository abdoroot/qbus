<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Translatable\HasTranslations;

/**
 * Class Terminal
 * @package App\Models
 * @version April 25, 2022, 11:14 pm UTC
 *
 * @property integer $provider_id
 * @property json $name
 */
class Terminal extends Model
{
    use HasFactory, HasTranslations;

    public $table = 'terminals';
    
    public $fillable = [
        'provider_id',
        'name'
    ];

    public $translatable = ['name'];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'provider_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|array',
        'name.*' => 'required|string|max:255'
    ];

    /**
     * Validation update rules
     *
     * @var array
     */
    public static $update_rules = [
        'name' => 'required|array',
        'name.*' => 'required|string|max:255'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function provider()
    {
        return $this->belongsTo(\App\Models\Provider::class, 'provider_id');
    }
}
