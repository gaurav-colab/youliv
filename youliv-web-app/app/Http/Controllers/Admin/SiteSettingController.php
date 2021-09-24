<?php

namespace App\Http\Controllers\admin;

use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\SiteSettings;
use DataTables;
use Validator;
use Exception;
use Session;
use Illuminate\Support\Facades\Hash;


class SiteSettingController extends Controller
{

    //
    public function __construct()
    {
    }

    public function store(Request $request,$id)
    {
	
      $validator = Validator::make($request->all(), [
        'title' => 'required',
        'meta_description' => 'required',       
      ]);

      if ($validator->fails()) {
        return back()->withErrors($validator)->withInput();
      }else{
		  $data=array();
		  $data['title']=$request['title'];
		   $data['meta_description']=$request['meta_description'];
          $updated = SiteSettings::where('id',$id)->update($data);
		  if($updated)
		  {
			Session::flash('success','Changes successfully updated.');			
		  }
		  else
		  {		
			Session::flash('error','Error occured while updateing data');	  
		  }
		  return redirect('admin/site_setting');
	  }
    } 
	
    public function create()
    {
        $sitesetting = SiteSettings::first();
		
        return view("admin.sitesetting.site_setting", compact('sitesetting'));
    }
/*
    // Dropzone Multi File Upload

    function upload(Request $request)
    {

        $images = $request->file('file');

        foreach ($images as $image) {

            $getImageName = time() . '.' . $image->getClientOriginalExtension();
            $path = 'assets/img/property_images';
            $image->move(public_path($path), $getImageName);
            //$imageName =  url($path . '/' . $getImageName);
            $imageName =  'public/'.$path . '/' . $getImageName;
            return response()->json(['success' => $imageName]);
        }
    }

    function delete(Request $request)
    {
        if ($request->get('name')) {
            \File::delete(public_path('images/' . $request->get('name')));
        }
    }

*/

}
