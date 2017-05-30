<?php

namespace App\Http\Controllers;

use \DB;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Display freepage.
     *
     * @param string $page
     *
     * @return Object
     */
    public function getFreepage($page)
    {
        return view('freepage.'.$page);
    }

    /**
     * Get prefecture and address.
     *
     * @return json
     */
    public function getPref()
    {
        $res = array();
        $input = request()->all();
        if (!$input) {
            return response()->json($res);
        }
        
        $zip = $input['zipcode'];
        
        $res = \DB::table('pref_infos')->where('zipcode', $zip)->first();
        if (!$res) {
            return response()->json($res);
        }
        
        $res = (array)$res;
        
        $m_pref = config('define.pref');
        $res['pref'] = array_search($res['pref'], $m_pref);
        
        return response()->json($res);
        
    }
}
