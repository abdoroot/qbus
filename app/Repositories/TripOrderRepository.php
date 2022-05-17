<?php

namespace App\Repositories;

use App\Models\TripOrder;
use App\Repositories\BaseRepository;

/**
 * Class TripOrderRepository
 * @package App\Repositories
 * @version April 13, 2022, 4:53 am UTC
*/

class TripOrderRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'trip_id',
        'user_id',
        'provider_id',
        'count',
        'total',
        'status',
        'user_notes',
        'provider_notes',
        'user_archive',
        'provider_archive',
        'fees',
        'tax',
        'coupon_id',
        'type',
        'admin_notes',
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
        return TripOrder::class;
    }
}
