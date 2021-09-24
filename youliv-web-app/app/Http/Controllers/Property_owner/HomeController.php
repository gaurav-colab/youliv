<?php

namespace App\Http\Controllers\Property_owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Only Authenticated users for "Property Owner" guard
     * are allowed.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:property_owner');
    }

    /**
     * Show Admin Dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        // return view('admin.home');
        
        return view('property_owner.dashboard.homepage');
    }
}
