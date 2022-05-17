<?php

namespace App\Repositories;

use App\Models\Additional;
use App\Repositories\BaseRepository;

/**
 * Class AdditionalRepository
 * @package App\Repositories
 * @version April 25, 2022, 11:10 pm UTC
*/

class AdditionalRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'icon'
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
        return Additional::class;
    }
}
