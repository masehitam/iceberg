<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class product
 * @package App\Models
 * @version May 28, 2017, 2:36 pm UTC
 */
class product extends Model
{
    use SoftDeletes;

    public $table = 'products';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'hid',
        'name',
        'start_date',
        'category',
        'zipcode',
        'company',
        'pref',
        'address01',
        'address02',
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
        'hid' => 'string',
        'name' => 'string',
        'start_date' => 'string',
        'category' => 'integer',
        'zipcode' => 'string',
        'company' => 'integer',
        'pref' => 'integer',
        'address01' => 'string',
        'address02' => 'string',
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
        'category' => 'required|exists:categories,id',
        'pref' => 'required',
        'address01' => 'required|max:255',
        'address02' => 'required|max:255',
        'description' => 'max:30000',
        'position' => 'max:30000',
        'display_flg' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function categories()
    {
        return $this->hasMany(\App\Models\category::class, 'id', 'id');
    }
}
