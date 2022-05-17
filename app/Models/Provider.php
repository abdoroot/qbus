<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Provider
 * @package App\Models
 * @version March 16, 2022, 11:19 am UTC
 *
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property string $password
 * @property string $image
 * @property string $notes
 * @property tinyinteger $approve
 * @property tinyinteger $block
 * @property string $block_notes
 * @property string $email_verification_code
 * @property string $phone_verification_code
 * @property string $email_verified_at
 * @property string $phone_verified_at
 * @property varchar $remember_token
 */
class Provider extends model
{
    use HasFactory;

    public $table = 'providers';

    public $fillable = [
        'name',
        'email',
        'phone',
        'comm_name',
        'comm_reg_num',
        'comm_reg_img',
        'tax_cert_num',
        'address',
        'image',
        'notes',
        'approve',
        'block',
        'block_notes',
        'email_verification_code',
        'phone_verification_code',
        'email_verified_at',
        'phone_verified_at',
        'rate',
        'cities',
        'tax',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'email' => 'string',
        'phone' => 'string',
        'image' => 'string',
        'notes' => 'string',
        'approve' => 'boolean',
        'block' => 'boolean',
        'block_notes' => 'string',
        'rate' => 'double',
        'cities' => 'json',
        'tax' => 'double',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => ['required','string','max:255', 'unique:providers,name'],
        'email' => ['required','string','max:255','email','unique:providers,email'],
        'phone' => ['required','string','max:255','regex:/^(?:\+971|00971|0)?(?:50|51|52|55|56|2|3|4|6|7|9)\d{7}$/m','unique:providers,phone'],
        'address' => ['required', 'string', 'max:255'],
        'comm_name' => ['required', 'string', 'max:255'],
        'comm_reg_num' => ['required', 'numeric'],
        'comm_reg_img' => ['required', 'image'],
        'tax_cert_num' => ['required', 'numeric'],
        'image' => ['nullable','image'],
        'username' => ['required','string','max:255', 'unique:accounts,username'],
        'password' => ['required','string','min:8','max:255'],
        'cities' => ['required','array'],
        'cities.*' => ['required','exists:cities,id'],
        'notes' => ['nullable','string'],
        'approve' => ['nullable','boolean'],
        'block' => ['nullable','boolean'],
        'block_notes' => ['nullable','required_if:block,1','string'],
        'tax' => ['nullable','min:0','max:100'],
        'rate' => ['nullable','min:0','max:5'],
    ];

    /**
     * Validation update rules
     *
     * @var array
     */
    public static $update_rules = [
        'name' => ['required','string','max:255', 'unique:providers,name'],
        'email' => ['required','string','max:255','email','unique:providers,email'],
        'phone' => ['required','string','max:255','regex:/^(?:\+971|00971|0)?(?:50|51|52|55|56|2|3|4|6|7|9)\d{7}$/m','unique:providers,phone'],
        'address' => ['required', 'string', 'max:255'],
        'comm_name' => ['required', 'string', 'max:255'],
        'comm_reg_num' => ['required', 'numeric'],
        'comm_reg_img' => ['nullable', 'image'],
        'tax_cert_num' => ['required', 'numeric'],
        'image' => ['nullable','image'],
        'cities' => ['required','array'],
        'cities.*' => ['required','exists:cities,id'],
        'notes' => ['nullable','string'],
        'approve' => ['nullable','boolean'],
        'block' => ['nullable','boolean'],
        'block_notes' => ['nullable','required_if:block,1','string'],
        'tax' => ['nullable','min:0','max:100'],
        'rate' => ['nullable','min:0','max:5'],
    ];

    public function getBlockSpanAttribute()
    {
        if(!$this->block) return '<span class="label label-success">'.__('msg.active').'</span>';
        return '<span class="label label-danger">'.__('msg.blocked').'</span>';
    }

    public function getApproveSpanAttribute()
    {
        if($this->approve) return '<span class="label label-success">'.__('models/providers.approved').'</span>';
        return '<span class="label label-warning">'.__('models/providers.unapproved').'</span>';
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function accounts()
    {
        return $this->hasMany(\App\Models\Account::class, 'provider_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function buses()
    {
        return $this->hasMany(\App\Models\Bus::class, 'provider_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function providerCities()
    {
        $cities = [];
        foreach($this->cities ?? [] as $city_id) {
            $city = \App\Models\City::find($city_id);
            if(!is_null($city)) $cities[] = $city;
        }

        return $cities;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function destinations()
    {
        return $this->hasMany(\App\Models\Destination::class, 'provider_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function reviews()
    {
        return $this->hasMany(\App\Models\Review::class, 'provider_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function busOrders()
    {
        return $this->hasMany(\App\Models\BusOrder::class, 'provider_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function trips()
    {
        return $this->hasMany(\App\Models\Trip::class, 'provider_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function tripOrders()
    {
        return $this->hasMany(\App\Models\TripOrder::class, 'provider_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function packages()
    {
        return $this->hasMany(\App\Models\Package::class, 'provider_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function packageOrders()
    {
        return $this->hasMany(\App\Models\PackageOrder::class, 'provider_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function terminals()
    {
        return $this->hasMany(\App\Models\Terminal::class, 'provider_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function notifications()
    {
        return $this->hasMany(\App\Models\Notification::class, 'provider_id');
    }

    public function getNotifications($read = -1, $skip = null, $limit = null)
    {
        $query = \App\Models\Notification::where('to', 'provider')
            ->where(function($query) {
                $query->where('provider_id', null)
                      ->orWhere('provider_id', $this->id);
            });

        if($read != -1) {
            $query->where('read_at', $read ? '!=' : '=', null);
        }

        if (!is_null($skip)) {
            $query->skip($skip);
        }

        if (!is_null($limit)) {
            $query->limit($limit);
        }

        return $query;
    }
}
