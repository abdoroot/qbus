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
        'additional',
        'rate'
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
        'rate' => 'double'
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
        return \App\Models\Destination::whereIn('id', $this->destinations ?? [])->get();
    }

    /**
    * @return \Illuminate\Database\Eloquent\Relations\HasMany
    **/
    public function reviews()
    {
        return $this->hasMany(\App\Models\Review::class, 'package_id');
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
                'id' => $value['id'],
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

    public function viewDiv(String $className = null)
    {
        $rate = "";
        for($i = 1; $i <= 5; $i++) {
            $rate .= "<svg class='w-5 h-5 text-gray-".($check = $i <= $this->rate ? '700' : '500')." fill-current ".($check ? 'dark:text-gray-300' : null)."'
                viewBox='0 0 24 24'>
                <path
                    d='M12 17.27L18.18 21L16.54 13.97L22 9.24L14.81 8.63L12 2L9.19 8.63L2 9.24L7.46 13.97L5.82 21L12 17.27Z' />
            </svg>";
        }

        $img = "";
        if(!is_null($image = $this->image)) {
            $img = asset('images/packages/'.$image);
        } elseif(!is_null($provider = $this->provider) && !is_null($image = $provider->image)) {
            $img = asset('images/providers/'.$image);
        } 
                    
        return "<div class='$className'>
            <a href='".route('packages.show', $this->id)."'>
                <div class='imgItem h-72 overflow-hidden'>
                    <img
                        class='object-cover object-center min-w-full h-full'
                        src='".$img."'
                        alt=''>
                </div>
                <!-- <div class='flex items-center px-2 py-3 bg-gray-900'>
                    <h1 class='mx-3 text-lg font-semibold text-white'>{$this->name}</h1>
                </div> -->
                <div class='px-2 py-4 border'>
                    <h1 class='text-xl font-semibold text-gray-800 dark:text-white'>
                        {$this->name}
                    </h1>
                    <div class='flex mt-2 item-center'>
                        $rate
                    </div>
                    <div class='flex items-center mt-4 text-gray-700 dark:text-gray-200'>
                        <svg class='w-6 h-6 fill-current' viewBox='0 0 24 24' fill='none'
                            xmlns='http://www.w3.org/2000/svg'>
                            <path d='M14 11H10V13H14V11Z' />
                            <path fill-rule='evenodd' clip-rule='evenodd'
                                d='M7 5V4C7 2.89545 7.89539 2 9 2H15C16.1046 2 17 2.89545 17 4V5H20C21.6569 5 23 6.34314 23 8V18C23 19.6569 21.6569 21 20 21H4C2.34314 21 1 19.6569 1 18V8C1 6.34314 2.34314 5 4 5H7ZM9 4H15V5H9V4ZM4 7C3.44775 7 3 7.44769 3 8V14H21V8C21 7.44769 20.5522 7 20 7H4ZM3 18V16H21V18C21 18.5523 20.5522 19 20 19H4C3.44775 19 3 18.5523 3 18Z' />
                        </svg>
                        <h1 class='px-2 text-lg'>".(!is_null($provider = $this->provider) ? $provider->name : '')."</h1>
                    </div>
                    <div class='flex items-center mt-4 text-gray-700 dark:text-gray-200'>
                        <svg class='w-6 h-6 fill-current' viewBox='0 0 24 24' fill='none'
                            xmlns='http://www.w3.org/2000/svg'>
                            <path fill-rule='evenodd' clip-rule='evenodd'
                                d='M16.2721 10.2721C16.2721 12.4813 14.4813 14.2721 12.2721 14.2721C10.063 14.2721 8.27214 12.4813 8.27214 10.2721C8.27214 8.063 10.063 6.27214 12.2721 6.27214C14.4813 6.27214 16.2721 8.063 16.2721 10.2721ZM14.2721 10.2721C14.2721 11.3767 13.3767 12.2721 12.2721 12.2721C11.1676 12.2721 10.2721 11.3767 10.2721 10.2721C10.2721 9.16757 11.1676 8.27214 12.2721 8.27214C13.3767 8.27214 14.2721 9.16757 14.2721 10.2721Z' />
                            <path fill-rule='evenodd' clip-rule='evenodd'
                                d='M5.79417 16.5183C2.19424 13.0909 2.05438 7.3941 5.48178 3.79418C8.90918 0.194258 14.6059 0.0543983 18.2059 3.48179C21.8058 6.90919 21.9457 12.606 18.5183 16.2059L12.3124 22.7241L5.79417 16.5183ZM17.0698 14.8268L12.243 19.8965L7.17324 15.0698C4.3733 12.404 4.26452 7.9732 6.93028 5.17326C9.59603 2.37332 14.0268 2.26454 16.8268 4.93029C19.6267 7.59604 19.7355 12.0269 17.0698 14.8268Z' />
                        </svg>
                        <h1 class='px-2 text-lg'>" . (
                            !is_null($startingCity = $this->startingCity) ? $startingCity->name : '-'
                        ) .
                        "</h1>
                    </div>
                    <div class='flex items-center mt-4 text-gray-700 dark:text-gray-200'>
                        <svg xmlns='http://www.w3.org/2000/svg' class='h-6 w-6' fill='none' viewBox='0 0 24 24' stroke='currentColor' stroke-width='2'>
                            <path stroke-linecap='round' stroke-linejoin='round' d='M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z' />
                        </svg>
                        <h1 class='px-2 text-lg'>{$this->date_from}</h1>
                    </div>
                </div>
            </a>
        </div>";
    }
}
