<?php

namespace App\Repositories;

use App\Models\FormBase;
use InfyOm\Generator\Common\BaseRepository;

class FormBaseRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'type',
        'title',
        'start_date',
        'end_date',
        'image',
        'limit_cnt',
        'body',
        'mail_title',
        'mail_body',
        'send_flg',
        'comp_msg',
        'aliase',
        'display_flg',
        'ad_tag'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return FormBase::class;
    }
}
