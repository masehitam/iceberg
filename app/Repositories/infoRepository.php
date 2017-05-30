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
        'id',
        'title',
        'link',
        'category',
        'public_date',
        'start_date',
        'end_date',
        'body',
        'display_flg',
        'toppage_flg',
        'important_flg',
        'delete_flg',
        'created_id',
        'updated_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return info::class;
    }
}
