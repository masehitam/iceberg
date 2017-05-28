<?php

namespace App\Repositories;

use App\Models\planning4;
use InfyOm\Generator\Common\BaseRepository;

class planning4Repository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        '[Btitle',
        'body'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return planning4::class;
    }
}
