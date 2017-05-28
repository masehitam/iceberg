<?php

namespace App\Repositories;

use App\Models\product;
use InfyOm\Generator\Common\BaseRepository;

class productRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'hid',
        'name',
        'start_date',
        'category',
        'zipcode',
        'company',
        'pref',
        'address01',
        'address02',
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
        return product::class;
    }
}
