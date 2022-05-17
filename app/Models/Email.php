<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Email
 * @package App\Models
 * @version April 21, 2022, 6:19 am UTC
 *
 * @property string $email
 */
class Email extends Model
{
    use HasFactory;

    public $table = 'emails';

    public $fillable = [
        'email'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'email' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'email' => 'required|string|max:255|email|unique:emails,email'
    ];

    /**
     * Validation update rules
     *
     * @var array
     */
    public static $update_rules = [
        'email' => 'required|string|max:255|email|unique:emails,email'
    ];

    
}
