<?php

namespace App\Repositories;

use App\Models\Destination;
use App\Repositories\BaseRepository;

/**
 * Class DestinationRepository
 * @package App\Repositories
 * @version April 7, 2022, 8:32 am UTC
*/

class DestinationRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'provider_id',
        'from_city_id',
        'to_city_id',
        'starting_terminal_id',
        'arrival_terminal_id',
        'stops',
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
        return Destination::class;
    }
}
