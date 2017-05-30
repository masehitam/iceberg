<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class FormQuestion
 * @package App\Models
 * @version May 30, 2017, 10:49 am UTC
 */
class FormQuestion extends Model
{
    use SoftDeletes;

    public $table = 'form_questions';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'id',
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
        'display_flg',
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
        'parent_id' => 'integer',
        'name' => 'string',
        'name_code' => 'string',
        'columns' => 'integer',
        'type' => 'integer',
        'options' => 'string',
        'default_value' => 'string',
        'required' => 'integer',
        'min_value' => 'integer',
        'max_value' => 'integer',
        'minlength' => 'integer',
        'maxlength' => 'integer',
        'regex' => 'string',
        'validation' => 'string',
        'rank' => 'integer',
        'description' => 'string',
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
