<?php

namespace App\Repositories;

use App\Models\PackageOrder;
use App\Repositories\BaseRepository;

/**
 * Class PackageOrderRepository
 * @package App\Repositories
 * @version April 13, 2022, 4:53 am UTC
*/

class PackageOrderRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'package_id',
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
        return PackageOrder::class;
    }
}
