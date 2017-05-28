<?php

namespace App\Repositories;

use App\Models\category;
use InfyOm\Generator\Common\BaseRepository;

class categoryRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'link',
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
        return category::class;
    }
}
