<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Auth;
use App\Http\Controllers\Controller;
use App\User;
use Mail;
use File;
use App\Mail\TestMail;
use DB;
use App\AreaManager;
use App\Property;
use App\Owner;
use App\Sector;
use App\State;
use App\City;
use App\Amenties;
use App\PropertyOwner;
use App\PropertyDetail;
use App\PropertyDescription;
use App\PropertyAdditionalInformation;
use App\PropertyImages;
use App\PropertyAmenities;
use App\PropertyAddress;
use App\Schedule;
use App\PropertyNeighbourhood;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redirect;
class ScheduleController extends Controller
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
     * @return \Illuminate\Contracts\Support\Renderable
     */
	public function index(Request $request,$id=null)
    {
		if($id!="")
		{
			$schedule=Schedule::where('user_id',$id)->with('user')->with('property_details')->with('property')->with('property_address')->get();
		}
		else
		{
			$schedule=Schedule::where('user_id','!=','')->with('user')->with('property_details')->with('property')->with('property_address')->get();
		}
		return view("admin.schedule.index",compact('schedule'));
	}
	public function edit(Request $request,$id)
    {
		$schedule=Schedule::where('id',$id)->with('user')->with('property_details')->with('property')->with('property_address')->first();
		
		if($request->isMethod('post'))
		{
		
		 $request->validate([
			'sh_date' => 'required',
			// 'pay_loc' => 'required',
			'sh_time' => 'required',
			//'mobilenumber' => 'required|string|max:255|unique:users,mobilenumber,'.Auth::user()->id,
		
		  ],[],[

		  ]);
		  
		  //$data=request()->except(['_token']);	
			$time=explode('-',$request->sh_time);
		
			$data['date']=date('Y-m-d',strtotime($request->sh_date));
			
			$data['time']=$request->sh_time;
			$data['status']=isset($request->status)? 1: 0;
			$data['approved']=isset($request->approved )? 1: 0;
				
			$data['visit_time']=date('Y-m-d H:i:s',strtotime($request->sh_date.' '.$time[0].':0:0'));	
			
			//$area_manager=Property::where('id',$schedule->property_id)->first();
			
			$data['area_manager_id']=$request->area_manager_id;
			$sh_create=Schedule::where('id',$id)->update($data);
			
			if($sh_create)			
			{
				return Redirect::back()->with('success', 'Schedule for property visit successfully updated.!'); 
			}
			else
			{
				return Redirect::back()->with('error', 'Your schedule for property visit successfully added.!'); 
			}
		}
		
		$area_managers = AreaManager::get()->toArray();
		
		return view("admin.schedule.edit",compact('schedule','area_managers'));
	}
    public function request_for_schedule(Request $request)
    {
		
		$time=explode('-',$request->sh_time);
	
		$data['date']=date('Y-m-d',strtotime($request->sh_date));
		
		$data['time']=$request->sh_time;
		$data['visit_time']=date('Y-m-d H:i:s',strtotime($request->sh_date.' '.$time[0].':0:0'));
		
		if($request->sh_id!="")
		{			
			$sh_create=Schedule::where('id',$request->sh_id)->update($data);
		}
		else
		{
			if(Auth::user())
			{
				$data['user_id']=Auth::user()->id;
			}
			else
			{
				$data['user_id']=NULL;
			}
			$data['property_id']=$request->property_id;
			$sh_create=Schedule::create($data);
		}		
		
		if(Auth::user() || (isset($request->sh_id) && $request->sh_id!=""))
		{
			return redirect('my_account')->with('success', 'Your schedule for property visit successfully added.!'); 
		}
		else
		{
			session(['sh_id' => $sh_create->id]);
			return redirect('login');
		}
        //return view('request_for_schedule');
    }

    function delete(Request $request,$id)
    {
        if (Schedule::where('id',$id)->exists()) {		  
			Schedule::where('id',$id)->delete();			
			return response()->json(['status' => 'success']);		 
		}
		else {
		  return response()->json(['status' => 'failure']);
		}
    }
    public function  cancel_visit(Request $request,$id)
	{
		if($id!="" && !isset($id))
		{
			return response()->json(['error'=> "Something went wrong"]);
		}
		else
		{
			$update=Schedule::where('id',$id)->update(array('status'=>0));
			if($update)
			{
					return response()->json(['code'=> 200,'success'=> "Visit canceled successfully"]);
			}
			else
			{
					return response()->json(['code'=> 201,'error'=> "Something went wrong"]);
			}
		}
	
	}
   
    
}
