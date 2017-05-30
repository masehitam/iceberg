<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class info
 * @package App\Models
 * @version May 29, 2017, 11:35 am UTC
 */
class info extends Model
{
    use SoftDeletes;

    public $table = 'infos';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
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
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'title' => 'string',
        'link' => 'string',
        'category' => 'integer',
        'body' => 'string',
        'display_flg' => 'integer',
        'toppage_flg' => 'integer',
        'important_flg' => 'integer',
        'delete_flg' => 'integer',
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
