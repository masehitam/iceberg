<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class planning4
 * @package App\Models
 * @version May 22, 2017, 11:10 am UTC
 */
class planning4 extends Model
{
    use SoftDeletes;

    public $table = 'planning4s';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        '[Btitle',
        'body'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        '[Btitle' => 'string',
        'body' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
