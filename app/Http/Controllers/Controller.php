<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $read = false;
    protected $write = false;

    public function __construct($func_id = 0)
    {
        if (session()->has('funcs') && array_key_exists($func_id, session('funcs'))) {
            $f = session('funcs')[$func_id];
            if ($f == 1) {
                $this->read = true;
            } elseif ($f == 2) {
                $this->read = true;
                $this->write = true;
            }
        }
    }
}
