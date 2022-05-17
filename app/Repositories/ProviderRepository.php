<?php

namespace App\Repositories;

use App\Models\Provider;
use App\Repositories\BaseRepository;

/**
 * Class ProviderRepository
 * @package App\Repositories
 * @version March 16, 2022, 11:19 am UTC
*/

class ProviderRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'email',
        'phone',
        'comm_name',
        'comm_reg_num',
        'tax_cert_num',
        'address',
        'notes',
        'approve',
        'block',
        'block_notes',
        'rate',
        'cities',
        'tax',
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
        return Provider::class;
    }
}
