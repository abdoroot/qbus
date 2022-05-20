<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Translatable\HasTranslations;

/**
 * Class Trip
 * @package App\Models
 * @version April 13, 2022, 4:51 am UTC
 *
 * @property \App\Models\Provider $provider
 * @property \App\Models\Bus $bus
 * @property \Illuminate\Database\Eloquent\Collection $tripCities
 * @property \Illuminate\Database\Eloquent\Collection $tripOrders
 * @property string $name
 * @property string $description
 * @property string $image
 * @property string $date_from
 * @property string $date_to
 * @property string $time_from
 * @property string $time_to
 * @property string $lat
 * @property string $lng
 * @property integer $zoom
 * @property integer $provider_id
 * @property integer $bus_id
 * @property number $fees
 * @property integer $max
 * @property string $provider_notes
 * @property boolean $provider_archive
 */
class Trip extends Model
{
    use HasFactory, HasTranslations;

    public $table = 'trips';

    public $fillable = [
        'name',
        'description',
        'image',
        'date_from',
        'date_to',
        'time_from',
        'time_to',
        'lat',
        'lng',
        'zoom',
        'provider_id',
        'bus_id',
        'fees',
        'max',
        'provider_notes',
        'provider_archive',
        'auto_approve',
        'rate',
        'destination_id',
        'additional'
    ];

    public $translatable = ['name', 'description'];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'json',
        'description' => 'json',
        'image' => 'string',
        'date_from' => 'string',
        'date_to' => 'string',
        'time_from' => 'string',
        'time_to' => 'string',
        'lat' => 'string',
        'lng' => 'string',
        'zoom' => 'integer',
        'provider_id' => 'integer',
        'bus_id' => 'integer',
        'fees' => 'float',
        'max' => 'integer',
        'provider_notes' => 'string',
        'provider_archive' => 'boolean',
        'auto_approve' => 'boolean',
        'rate' => 'double',
        'destination_id' => 'integer',
        'additional' => 'array',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        // 'name' => 'required|array',
        // 'name.*' => 'required|string|max:255',
        'description' => 'nullable|array',
        'description.*' => 'nullable|string',
        // 'image' => 'required|image',
        'date_from' => 'required|date_format:Y-m-d',
        'date_to' => 'required|date_format:Y-m-d|after_or_equal:date_from',
        'time_from' => 'required|date_format:H:i',
        'time_to' => 'required|date_format:H:i|after:time_from',
        // 'lat' => 'required|numeric',
        // 'lng' => 'required|numeric',
        // 'zoom' => 'required|integer',
        'provider_id' => 'nullable|exists:providers,id',
        'bus_id' => 'required|exists:buses,id',
        'fees' => 'required|numeric|min:0',
        // 'max' => 'required|integer',
        'provider_notes' => 'nullable|string',
        'provider_archive' => 'nullable|boolean',
        'auto_approve' => 'required|boolean',
        'destination_id' => 'required|exists:destinations,id',
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
        // 'name' => 'required|array',
        // 'name.*' => 'required|string|max:255',
        'description' => 'nullable|array',
        'description.*' => 'nullable|string',
        // 'image' => 'required|image',
        'date_from' => 'required|date_format:Y-m-d',
        'date_to' => 'required|date_format:Y-m-d|after_or_equal:date_from',
        'time_from' => 'required|date_format:H:i',
        'time_to' => 'required|date_format:H:i|after:time_from',
        // 'lat' => 'required|numeric',
        // 'lng' => 'required|numeric',
        // 'zoom' => 'required|integer',
        'provider_id' => 'nullable|exists:providers,id',
        'bus_id' => 'required|exists:buses,id',
        'fees' => 'required|numeric|min:0',
        // 'max' => 'required|integer',
        'provider_notes' => 'nullable|string',
        'provider_archive' => 'nullable|boolean',
        'auto_approve' => 'required|boolean',
        'destination_id' => 'required|exists:destinations,id',
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
    public function bus()
    {
        return $this->belongsTo(\App\Models\Bus::class, 'bus_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function destination()
    {
        return $this->belongsTo(\App\Models\Destination::class, 'destination_id');
    }

    public function additionals()
    {
        $additionals = [];
        foreach($this->additional ?? [] as $value) {
            $additional = \App\Models\Additional::find($value['id']);
            if(!is_null($additional)) {
                $additionals[] = [
                    'id' => $additional->id,
                    'additional' => $additional,
                    'fees' => $value['fees']];
            }
        }

        return $additionals;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function tripOrders()
    {
        return $this->hasMany(\App\Models\TripOrder::class, 'trip_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function tickets()
    {
        return \App\Models\Ticket::join('trip_orders', 'trip_orders.id', '=', 'tickets.trip_order_id')
            ->where('trip_orders.trip_id', '=', $this->id)
            ->select('tickets.*')->get();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function datetimes()
    {
        return $this->hasMany(\App\Models\BusDatetime::class, 'trip_id');
    }

    /**
    * @return \Illuminate\Database\Eloquent\Relations\HasMany
    **/
    public function reviews()
    {
        return $this->hasMany(\App\Models\Review::class, 'trip_id');
    }

    public function getAutoApproveSpanAttribute()
    {
        if($this->auto_approve) return '<span class="label label-success">'.__('msg.yes').'</span>';
        return '<span class="label label-primary">'.__('msg.no').'</span>';
    }

    public function getAvailableAttribute()
    {
        return $this->max - $this->tickets()->count();
    }

    public function getNameAttribute()
    {
        return '#' . $this->id;
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
        if(!is_null($bus = $this->bus) && !is_null($image = $bus->image)) {
            $img = asset('images/buses/'.$image);
        } 
                    
        return "<div class='$className'>
        <a href='".route('trips.show', $this->id)."'>
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
                    {$this->name} " . 
                    (!is_null($destination = $this->destination) ? ' - ' . $destination->name : '') . "
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
                        !is_null($destination) ? (
                            !is_null($terminal = $destination->arrivalTerminal) ? $terminal->name 
                            : null) 
                        : null) . 
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
