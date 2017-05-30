<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class category2
 * @package App\Models
 * @version May 30, 2017, 7:53 am UTC
 */
class category2 extends Model
{
    use SoftDeletes;

    public $table = 'category2s';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'parent_id' => 'integer',
        'level' => 'integer',
        'rank' => 'integer',
        'image' => 'string',
        'top_image' => 'string',
        'description' => 'string',
        'position' => 'string',
        'display_flg' => 'integer',
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
