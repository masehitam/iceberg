<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class sample
 * @package App\Models
 * @version May 30, 2017, 3:58 am UTC
 */
class sample extends Model
{
    use SoftDeletes;

    public $table = 'samples';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'title',
        'image',
        'pref',
        'popular',
        'display_flg'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'title' => 'string',
        'subtitle' => 'string',
        'answer001' => 'string',
        'email' => 'string',
        'start_date' => 'string',
        'number' => 'integer',
        'zipcode' => 'string',
        'password' => 'string',
        'image' => 'string',
        'category' => 'integer',
        'pref' => 'integer',
        'popular' => 'integer',
        'display_flg' => 'integer',
        'hid' => 'integer',
        'created_id' => 'integer',
        'updated_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'title' => 'required|max:255',
        'subtitle' => 'required|max:255',
        'answer001' => 'max:30000',
        'email' => 'required|max:255',
        'password' => 'required',
        'category' => 'exists:categories,id',
        'pref' => 'required',
        'popular' => 'required',
        'display_flg' => 'required'
    ];

    
}
