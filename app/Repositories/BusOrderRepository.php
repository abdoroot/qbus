<?php

namespace App\Repositories;

use App\Models\BusOrder;
use App\Repositories\BaseRepository;

/**
 * Class BusOrderRepository
 * @package App\Repositories
 * @version March 28, 2022, 8:42 am UTC
*/

class BusOrderRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'date_from',
        'time_from',
        'date_to',
        'time_to',
        'user_id',
        'provider_id',
        'bus_id',
        'fees',
        'status',
        'user_notes',
        'provider_notes',
        'user_archive',
        'provider_archive',
        'destination',
        'tax',
        'total',
        'created_at'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return BusOrder::class;
    }
}
