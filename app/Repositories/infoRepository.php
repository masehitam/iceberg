<?php

namespace App\Repositories;

use App\Models\info;
use InfyOm\Generator\Common\BaseRepository;

class infoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
        'link',
        'zipcode',
        'image',
        'category',
        'public_date',
        'start_date',
        'end_date',
        'body',
        'display_flg',
        'toppage_flg',
        'popular'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return info::class;
    }
}
