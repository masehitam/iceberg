<?php

namespace App\Repositories;

use App\Models\review;
use InfyOm\Generator\Common\BaseRepository;

class reviewRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id',
        'postid',
        'fileid',
        'document_class',
        'comment',
        'created_id',
        'updated_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return review::class;
    }
}
