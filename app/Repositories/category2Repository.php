<?php

namespace App\Repositories;

use App\Models\category2;
use InfyOm\Generator\Common\BaseRepository;

class category2Repository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'parent_id',
        'level',
        'rank',
        'image',
        'top_image',
        'description',
        'position',
        'display_flg'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return category2::class;
    }
}
