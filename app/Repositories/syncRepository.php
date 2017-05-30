<?php

namespace App\Repositories;

use App\Models\sync;
use InfyOm\Generator\Common\BaseRepository;

class syncRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id',
        'public_date',
        'description',
        'accept',
        'finish',
        'created_id',
        'updated_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return sync::class;
    }
}
