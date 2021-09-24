<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Property;
use App\SiteSettings;

class IndexController extends Controller
{

    public function index(){
        
		$sitesetting = SiteSettings::first();
        $propertyListing    =   Property::with(['property_descriptions'=> function($query){ $query->select('room_type','description','rent','property_id');}])->with('property_images')->with('property_details')
		->whereHas('property_details', function($q)  {
       // Query the name field in status table
       $q->where('featured', '=', 1);})->where('status',1)->get();  
		
        return view('welcome', compact('propertyListing','sitesetting'));
    }
}
