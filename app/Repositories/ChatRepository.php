<?php

namespace App\Repositories;

use App\Models\Chat;
use App\Repositories\BaseRepository;

/**
 * Class ChatRepository
 * @package App\Repositories
 * @version March 22, 2022, 10:48 am UTC
*/

class ChatRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'provider_id',
        'user_id',
        'trip_id',
        'package_id',
        'bus_id',
        'trip_order_id',
        'package_order_id',
        'bus_order_id',
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
        return Chat::class;
    }
}
