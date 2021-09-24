<?php

namespace App\Http\Controllers\admin;

use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Sector;
use App\State;
use App\City;
use DataTables;
use Validator;
use Exception;
use Session;
use Illuminate\Support\Facades\Hash;


class SectorController extends Controller
{

    //
    public function __construct()
    {
    }
	public function city_list()
	{
	   //Owner::where('owner_number', $request->owner_number)->get();
	   $cities=City::get();
	   return view('admin.sector.cities',compact('cities'));
	}
	public function index(Request $request,$id=null)
	{
	   //Owner::where('owner_number', $request->owner_number)->get();
	   if($id!="")
	   {
		$sector=Sector::where('city_id',$id)->get();
		$cities=City::where('id',$request->id)->first();
		$city_name=$cities->name;
		return view('admin.sector.index',compact('sector','city_name','id'));
	   }
	   else
	   {
		   return back()->with("error",'Invalid ID provided');
	   }
	}
	public function create(Request $request,$id=null)
	{
		if($id!="")
		{
			$cities=City::where('id',$id)->first();
			$city_name=$cities->name;
			return view('admin.sector.add',compact('city_name','id'));
		}
		else
		{
			return back()->with("error",'Invalid ID provided');
		}
	}

    /*
    *
    *   save Property owner Details
    *
    */

    public function store(Request $request,$id=null)
    {
        // OwnerImage
		$validator = Validator::make($request->all(), [
			'name' => 'required|max:50',			
		  ]);

		if ($validator->fails()) {
		return back()->withErrors($validator)->withInput();
		}else
		{	
	

			$sector = new Sector();
			$sector->name  = $request->name;
			$sector->slug  = $request->slug;
			$sector->city_id = $id;		
			$sector->save();
			$sector_id = $sector->id;			
		  if($sector_id)
		  {
				Session::flash('success','Sector successfully added.');			
		  }
		  else
		  {		
			Session::flash('error','Error occured while updateing data');	  
		  }
		  
		 return redirect('admin/sector_list/'.$id);
		}
    }
   public function update(Request $request,$id)
    {
        // OwnerImage
		$validator = Validator::make($request->all(), [
			'name' => 'required|max:50',	
			'slug' => 'required|max:50',			
		  ]);

		if ($validator->fails()) {
		return back()->withErrors($validator)->withInput();
		}else
		{	
			$sectors=Sector::where('id', $id)->first();

			
			$data['name']  = $request->name;
			$data['slug']  = $request->slug;
			$data['city_id']  = $sectors->city_id;
			
			if(!empty($sectors)){
				$sector_update	=	Sector::where('id', $id)
							->update($data);

				

			}else{
					Session::flash('error','Error occured while updating data');	  
			}

			}
		   if($sector_update)
		  {
			Session::flash('success','Sector detail successfully updated.');			
		  }
		  else
		  {		
			Session::flash('error','Error occured while updating data');	  
		  }
		  
		 return redirect('admin/sector_list/'.$sectors->city_id);
		
    }
	
	public function fetch($city_id,$id)
    {
       
        if($city_id!="")
		{
			$cities=City::where('id',$city_id)->first();
			$city_name=$cities->name;
			$sector=Sector::where('id',$id)->first();
			return view('admin.sector.edit',compact('sector','city_name','id'));
		}
		else
		{
			return back()->with("error",'Invalid ID provided');
		}
    }

    function delete(Request $request,$id)
    {
        if (Sector::where('id',$id)->exists()) {		  
		Sector::where('id',$id)->delete();
		return response()->json(['status' => 'success']);		 
		}
		else {
		  return response()->json(['status' => 'failure']);
		}
    }



}
