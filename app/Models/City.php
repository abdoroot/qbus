<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Translatable\HasTranslations;

/**
 * Class City
 * @package App\Models
 * @version March 22, 2022, 8:02 am UTC
 *
 * @property string $name
 */
class City extends Model
{
    use HasFactory, HasTranslations;

    public $table = 'cities';

    public $fillable = ['name'];

    public $translatable = ['name'];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        //
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|array',
        'name.*' => 'required|string|max:255',
    ];

    /**
     * Validation update rules
     *
     * @var array
     */
    public static $update_rules = [
        'name' => 'required|array',
        'name.*' => 'required|string|max:255',
    ];
}
