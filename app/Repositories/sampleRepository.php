<?php

namespace App\Repositories;

use App\Models\sample;
use InfyOm\Generator\Common\BaseRepository;

class sampleRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
        'image',
        'category'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return sample::class;
    }
}
