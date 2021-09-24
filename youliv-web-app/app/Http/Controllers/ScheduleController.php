<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

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
class ScheduleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function request_for_schedule(Request $request)
    {
		
		$time=explode('-',$request->sh_time);
	
		$data['date']=date('Y-m-d',strtotime($request->sh_date));
		
		$data['time']=$request->sh_time;
		$data['visit_time']=date('Y-m-d H:i:s',strtotime($request->sh_date.' '.$time[0].':0:0'));	
		
		
		
		
		if($request->sh_id!="")
		{		
			//$sch_detail=Schedule::where('id',$request->sh_id)->first();	
			//$data['area_manager_id']=$sch_detail->area_manager_id;
			$data['status']=1;
			$sh_create=Schedule::where('id',$request->sh_id)->update($data);
		}
		else
		{
			$data['property_id']=$request->property_id;
			$area_manager=Property::where('id',$request->property_id)->first();	
			$data['area_manager_id']=$area_manager->area_manager_id;
			if(Auth::user())
			{
				$data['user_id']=Auth::user()->id;
			}
			else
			{
				$data['user_id']=NULL;
			}
			
			
			$sh_create=Schedule::create($data);
		}		
		
		if(Auth::user() || (isset($request->sh_id) && $request->sh_id!=""))
		{
			$msg=($request->sh_id!="" ? 'Your schedule for property visit successfully updated.!' : 'Your schedule for property visit successfully added.!');
			
				
			return redirect('my_account')->with('success', $msg); 
		}		
		else
		{
			session(['sh_id' => $sh_create->id]);
			return redirect('login');
		}
        //return view('request_for_schedule');
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
   
   public function  request_for_call(Request $request)
	{
		if($request->request_phone=="" && $request->request_name="" && !isset($request->request_phone) && !isset($request->request_name))
		{
			
			return response()->json(['code'=> 201,'error'=> 'Something went wrong']);
		}
		else
		{
			$name=$request->get('request_name');
			try {
				
				//$key=$_ENV['NEXMO_KEY'];	
				//$secret=$_ENV['NEXMO_SECRET'];		
				$brand=config('app.brand');
				$send_mail=config('app.sendmail');
				//$send_phone=$_ENV['SEND_PHONE'];
			  Mail::send('request_for_call',
				   array(
					   'name' => $request->get('request_name'),					   
					   'phone' => $request->get('request_phone'),					 
				   ), function($message) use ($name,$send_mail,$brand)
			   {
				   $message->from($send_mail);
				   $message->to($send_mail, $brand)->subject($name.' requesting for call');
			   });
			   return response()->json(['code'=>200,'success'=>"The request for call sent successfully"]);
			//$mobile="7589368301";	
								
				/*$basic  = new \Nexmo\Client\Credentials\Basic($key, $secret);
				$client = new \Nexmo\Client($basic);
			
					 $num = $request->get('request_phone');
					 $numlength = strlen((string)$num);
					if($numlength == 12){
						//dd('12'); die;
						$number = $request->get('request_phone');
					}else{
						
						$number = '+91'.$request->get('request_phone');
						}
					
				
				$response = $client->sms()->send(
						new \Vonage\SMS\Message\SMS($send_phone, $brand, $request->get('request_name').'('.$request->get('request_phone').') has request for a call.')
					);

					$message = $response->current();

					if ($message->getStatus() == 0) {
						return response()->json(['code'=>200,'success'=>"The request for call sent successfully"]);
					} else {
						
						//return response()->json(['error' => false,'code'=>201,'messages'=> $message->getStatus()]);
						return response()->json(['error' => false,'code'=>201,'messages'=>"Something went wrong"]);
					}
				*/
				//$message = $response->current();
				//if ($message->getStatus() == 0) {
					//return response()->json(['code'=>200,'success'=>"The request for call sent successfully"]);
				//} else {
					//echo "The message failed with status: " . $message->getStatus() . "\n";
					//return response()->json(['code'=>201,'error'=>"The message failed with status: " . $message->getStatus() . "\n"]);
					
					//return response()->json(['error' => false,'code'=>201,'messages'=>"Something went wrong"]);
				//}
			}
			catch (\Exception $e) {
					// Do what you want here... 
					// Log::error('nexmo failed...');
					 //echo 'Caught exception: ',  $e->getMessage(), "\n";
					//$warning= "The message failed with status: " . $message->getStatus();
					//return response()->json(['code'=> 201,'success'=> $warning]);$messages=$e->getMessage();
						return response()->json(['code'=> 201,'error'=> $e->getMessage()]);
					// Log::error($e->getMessage());
					// dd($e->getMessage())
			}
			
			
			
		}
	
	}

    

}
