<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class category
 * @package App\Models
 * @version May 25, 2017, 9:36 am UTC
 */
class category extends Model
{
    use SoftDeletes;

    public $table = 'categories';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'link',
        'parent_id',
        'level',
        'rank',
        'image',
        'top_image',
        'description',
        'position',
        'display_flg'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'link' => 'string',
        'parent_id' => 'integer',
        'level' => 'integer',
        'rank' => 'integer',
        'image' => 'string',
        'top_image' => 'string',
        'description' => 'string',
        'position' => 'string',
        'display_flg' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|max:255',
        'link' => 'url|max:255',
        'description' => 'max:30000',
        'position' => 'max:30000',
        'display_flg' => 'required'
    ];

    
}
