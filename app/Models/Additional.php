<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Translatable\HasTranslations;

/**
 * Class Additional
 * @package App\Models
 * @version April 25, 2022, 11:10 pm UTC
 *
 * @property json $name
 * @property string $icon
 */
class Additional extends Model
{
    use HasFactory, HasTranslations;

    public $table = 'additionals';
    
    public $fillable = [
        'name',
        'icon'
    ];

    public $translatable = ['name'];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'icon' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|array',
        'name.*' => 'required|string|max:255',
        'icon' => 'required|string|max:255'
    ];

    /**
     * Validation update rules
     *
     * @var array
     */
    public static $update_rules = [
        'name' => 'required|array',
        'name.*' => 'required|string|max:255',
        'icon' => 'required|string|max:255'
    ];

    
}
