<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class info
 * @package App\Models
 * @version June 3, 2017, 9:59 am UTC
 */
class info extends Model
{
    use SoftDeletes;

    public $table = 'infos';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
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
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'title' => 'string',
        'link' => 'string',
        'zipcode' => 'string',
        'image' => 'string',
        'category' => 'integer',
        'public_date' => 'string',
        'start_date' => 'string',
        'end_date' => 'string',
        'body' => 'string',
        'display_flg' => 'integer',
        'toppage_flg' => 'integer',
        'popular' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'title' => 'required|max:255',
        'link' => 'url|max:255',
        'public_date' => 'required',
        'start_date' => 'required|date|before:end_date',
        'end_date' => 'required|date|after:start_date',
        'body' => 'max:30000',
        'display_flg' => 'required',
        'toppage_flg' => 'required'
    ];

    
}
