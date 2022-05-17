<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Translatable\HasTranslations;

/**
 * Class Service
 * @package App\Models
 * @version April 21, 2022, 2:12 am UTC
 *
 * @property json $title
 * @property json $text
 * @property string $image
 */
class Service extends Model
{
    use HasFactory, HasTranslations;

    public $table = 'services';

    public $fillable = [
        'title',
        'text',
        'image'
    ];

    public $translatable = ['title', 'text'];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'image' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'title' => 'required|array',
        'title.*' => 'required|string|max:100',
        'text' => 'required|array',
        'text.*' => 'required|string',
        'image' => 'required|image'
    ];

    /**
     * Validation update rules
     *
     * @var array
     */
    public static $update_rules = [
        'title' => 'required|array',
        'title.*' => 'required|string|max:100',
        'text' => 'required|array',
        'text.*' => 'required|string',
        'image' => 'nullable|image'
    ];

    
}
