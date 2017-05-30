<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class review
 * @package App\Models
 * @version May 29, 2017, 11:35 am UTC
 */
class review extends Model
{
    use SoftDeletes;

    public $table = 'reviews';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'id',
        'postid',
        'fileid',
        'document_class',
        'comment',
        'created_id',
        'updated_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'postid' => 'integer',
        'fileid' => 'integer',
        'document_class' => 'integer',
        'comment' => 'string',
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
