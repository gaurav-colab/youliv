<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User; 
use App\PropertyOwner;
use App\AreaManager;

class HomeController extends Controller
{
    /**
     * Only Authenticated users for "admin" guard
     * are allowed.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show Admin Dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){

        $usercount = User::count();
        
        $propertyusercount = PropertyOwner::count();

        $areamangerusercount = AreaManager::count();


        // return view('admin.home');
        return view('admin.dashboard.homepage',compact('usercount','propertyusercount','areamangerusercount'));
    }
}
