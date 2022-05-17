<?php

namespace App\Repositories;

use App\Models\Bus;
use App\Repositories\BaseRepository;

/**
 * Class BusRepository
 * @package App\Repositories
 * @version March 24, 2022, 12:51 am UTC
*/

class BusRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'plate',
        'passengers',
        'account_id',
        'provider_id',
        'active',
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
        return Bus::class;
    }
}
