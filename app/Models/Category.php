<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Translatable\HasTranslations;

/**
 * Class Category
 * @package App\Models
 * @version March 22, 2022, 8:04 am UTC
 *
 * @property string $name
 */
class Category extends Model
{
    use HasFactory, HasTranslations;

    public $table = 'categories';

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
        'name' => 'required|array', // string|max:255|unique:categories,name
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
