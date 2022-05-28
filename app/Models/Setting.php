<?php

namespace App\Models;

use Eloquent as Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Setting
 * @package App\Models
 * @version August 22, 2021, 7:59 am UTC
 */
class Setting extends Model
{
    use HasFactory, HasTranslations;

    public $table = 'settings';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    public $fillable = [
        'key',
        'value',
        'type',
        'group',
        'description',
        'rules',
        'trans'
    ];

    public $translatable = ['trans'];

    public static $trans = [
        'about_title',
        'about_subtitle',
        'about_text',
        'features_title',
        'services_title',
        'services_subtitle',
        'contact_title',
        'contact_subtitle',
        'location',
        'copyright',
        'links_title',
        'download_title',
        'contact_title',
        'provider_title',
        'provider_subtitle',
        'email_title',
        'feedback_title',
        'feedback_subtitle',
        'feedback_footer',
        'section_title',
        'section_text',
        'section_text',
        'privacy_policy',
        'return_policy',
    ];


    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'key' => 'string',
        'value' => 'string',
        'type' => 'string',
        'group' => 'string',
        'description' => 'string',
        'rules' => 'string',
        'trans' => 'json'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'key' => 'required|string|max:255',
        'value' => 'nullable|string',
        'trans' => 'nullable|array',
        'type' => 'nullable|string|in:text,number,email,textarea,editor,checkbox,file,url',
        'group' => 'nullable|string|max:255',
        'description' => 'nullable|string|max:255',
        'rules' => 'nullable|string|max:255'
    ];

    public static function values($key)
    {
        if(!is_null($setting = \App\Models\Setting::where('key', $key)->first())) {
            if(in_array($key, \App\Models\Setting::$trans)) {
                return $setting->trans;
            }
            return $setting->value;
        }
        return null;
    }
}
