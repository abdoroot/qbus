<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Translatable\HasTranslations;

/**
 * Class Feature
 * @package App\Models
 * @version April 21, 2022, 1:59 am UTC
 *
 * @property json $title
 * @property json $text
 * @property string $icon
 */
class Feature extends Model
{
    use HasFactory, HasTranslations;

    public $table = 'features';

    public $fillable = [
        'title',
        'text',
        'icon'
    ];

    public $translatable = ['title', 'text'];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'icon' => 'string',
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
        // 'icon' => 'required|image'
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
        // 'icon' => 'nullable|image'
    ];

    
}
