<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class FormAnswer
 * @package App\Models
 * @version May 30, 2017, 7:54 am UTC
 */
class FormAnswer extends Model
{
    use SoftDeletes;

    public $table = 'form_answers';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'parent_id' => 'integer',
        'answer001' => 'string',
        'answer002' => 'string',
        'answer003' => 'string',
        'answer004' => 'string',
        'answer005' => 'string',
        'answer006' => 'string',
        'answer007' => 'string',
        'answer008' => 'string',
        'answer009' => 'string',
        'answer010' => 'string',
        'answer011' => 'string',
        'answer012' => 'string',
        'answer013' => 'string',
        'answer014' => 'string',
        'answer015' => 'string',
        'answer016' => 'string',
        'answer017' => 'string',
        'answer018' => 'string',
        'answer019' => 'string',
        'answer020' => 'string',
        'answer021' => 'string',
        'answer022' => 'string',
        'answer023' => 'string',
        'answer024' => 'string',
        'answer025' => 'string',
        'answer026' => 'string',
        'answer027' => 'string',
        'answer028' => 'string',
        'answer029' => 'string',
        'answer030' => 'string',
        'answer031' => 'string',
        'answer032' => 'string',
        'answer033' => 'string',
        'answer034' => 'string',
        'answer035' => 'string',
        'answer036' => 'string',
        'answer037' => 'string',
        'answer038' => 'string',
        'answer039' => 'string',
        'answer040' => 'string',
        'answer041' => 'string',
        'answer042' => 'string',
        'answer043' => 'string',
        'answer044' => 'string',
        'answer045' => 'string',
        'answer046' => 'string',
        'answer047' => 'string',
        'answer048' => 'string',
        'answer049' => 'string',
        'answer050' => 'string',
        'answer051' => 'string',
        'answer052' => 'string',
        'answer053' => 'string',
        'answer054' => 'string',
        'answer055' => 'string',
        'answer056' => 'string',
        'answer057' => 'string',
        'answer058' => 'string',
        'answer059' => 'string',
        'answer060' => 'string',
        'answer061' => 'string',
        'answer062' => 'string',
        'answer063' => 'string',
        'answer064' => 'string',
        'answer065' => 'string',
        'answer066' => 'string',
        'answer067' => 'string',
        'answer068' => 'string',
        'answer069' => 'string',
        'answer070' => 'string',
        'answer071' => 'string',
        'answer072' => 'string',
        'answer073' => 'string',
        'answer074' => 'string',
        'answer075' => 'string',
        'answer076' => 'string',
        'answer077' => 'string',
        'answer078' => 'string',
        'answer079' => 'string',
        'answer080' => 'string',
        'answer081' => 'string',
        'answer082' => 'string',
        'answer083' => 'string',
        'answer084' => 'string',
        'answer085' => 'string',
        'answer086' => 'string',
        'answer087' => 'string',
        'answer088' => 'string',
        'answer089' => 'string',
        'answer090' => 'string',
        'answer091' => 'string',
        'answer092' => 'string',
        'answer093' => 'string',
        'answer094' => 'string',
        'answer095' => 'string',
        'answer096' => 'string',
        'answer097' => 'string',
        'answer098' => 'string',
        'answer099' => 'string',
        'answer100' => 'string',
        'answer101' => 'string',
        'answer102' => 'string',
        'answer103' => 'string',
        'answer104' => 'string',
        'answer105' => 'string',
        'answer106' => 'string',
        'answer107' => 'string',
        'answer108' => 'string',
        'answer109' => 'string',
        'answer110' => 'string',
        'answer111' => 'string',
        'answer112' => 'string',
        'answer113' => 'string',
        'answer114' => 'string',
        'answer115' => 'string',
        'answer116' => 'string',
        'answer117' => 'string',
        'answer118' => 'string',
        'answer119' => 'string',
        'answer120' => 'string',
        'answer121' => 'string',
        'answer122' => 'string',
        'answer123' => 'string',
        'answer124' => 'string',
        'answer125' => 'string',
        'answer126' => 'string',
        'answer127' => 'string',
        'answer128' => 'string',
        'answer129' => 'string',
        'answer130' => 'string',
        'answer131' => 'string',
        'answer132' => 'string',
        'answer133' => 'string',
        'answer134' => 'string',
        'answer135' => 'string',
        'answer136' => 'string',
        'answer137' => 'string',
        'answer138' => 'string',
        'answer139' => 'string',
        'answer140' => 'string',
        'answer141' => 'string',
        'answer142' => 'string',
        'answer143' => 'string',
        'answer144' => 'string',
        'answer145' => 'string',
        'answer146' => 'string',
        'answer147' => 'string',
        'answer148' => 'string',
        'answer149' => 'string',
        'answer150' => 'string',
        'conversion_param' => 'string',
        'ip_address' => 'string',
        'user_agent' => 'string',
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
