<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class FormBase
 * @package App\Models
 * @version May 30, 2017, 10:43 am UTC
 */
class FormBase extends Model
{
    use SoftDeletes;

    public $table = 'form_bases';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'id',
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
        'ad_tag',
        'created_id',
        'updated_id',
        'created_at',
        'updated_at'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'type' => 'integer',
        'title' => 'string',
        'start_date' => 'string',
        'end_date' => 'string',
        'image' => 'string',
        'limit_cnt' => 'integer',
        'body' => 'string',
        'mail_title' => 'string',
        'mail_body' => 'string',
        'send_flg' => 'integer',
        'comp_msg' => 'string',
        'aliase' => 'string',
        'display_flg' => 'integer',
        'ad_tag' => 'string',
        'created_id' => 'integer',
        'updated_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
