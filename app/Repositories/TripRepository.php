<?php

namespace App\Repositories;

use App\Models\Trip;
use App\Repositories\BaseRepository;

/**
 * Class TripRepository
 * @package App\Repositories
 * @version April 13, 2022, 4:51 am UTC
*/

class TripRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
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
        'additional',
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
        return Trip::class;
    }
}
