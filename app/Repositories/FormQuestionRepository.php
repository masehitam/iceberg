<?php

namespace App\Repositories;

use App\Models\FormQuestion;
use InfyOm\Generator\Common\BaseRepository;

class FormQuestionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'parent_id',
        'name',
        'name_code',
        'columns',
        'type',
        'options',
        'default_value',
        'required',
        'min_value',
        'max_value',
        'minlength',
        'maxlength',
        'regex',
        'validation',
        'rank',
        'description',
        'display_flg'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return FormQuestion::class;
    }
}
