<?php

namespace App\Repositories;

use App\Models\Terminal;
use App\Repositories\BaseRepository;

/**
 * Class TerminalRepository
 * @package App\Repositories
 * @version April 25, 2022, 11:14 pm UTC
*/

class TerminalRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'provider_id',
        'name'
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
        return Terminal::class;
    }
}
