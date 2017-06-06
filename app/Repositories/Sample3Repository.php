<?php

namespace App\Repositories;

use App\Models\Sample3;
use InfyOm\Generator\Common\BaseRepository;

class Sample3Repository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title1',
        'image',
        'category'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Sample3::class;
    }
}
