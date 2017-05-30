<?php

namespace App\Repositories;

use App\Models\tag;
use InfyOm\Generator\Common\BaseRepository;

class tagRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id',
        'postid',
        'document_class',
        'tag',
        'created_id',
        'updated_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return tag::class;
    }
}
