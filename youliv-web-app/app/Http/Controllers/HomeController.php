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
use App\PropertyRequestDescription;
use App\PropertyRequestDetail;
use App\PropertyRequestAmenities;
use App\PropertyAdditionalInformation;
use App\PropertyImages;
use App\PropertyAmenities;
use App\PropertyAddress;
use App\PropertyNeighbourhood;
use Illuminate\Support\Str;
use App\Schedule;
use App\Favorite;

use Illuminate\Support\Facades\Validator;
class HomeController extends Controller
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
    public function index()
    {
        return view('home');
    }

    public function terms_conditions()
    {
        return view('terms_conditions');
    }


    public function privacy_policy()
    {
        return view('privacy_policy');
    }
//title,about,property_available,property_type_text
//geo_location,,address_building 

//property_descriptions,property_neighbourhoods,property_additional_information
    public function propertylist(Request $request)
    {
		//dd($request);
		$list=array();
		$latitude=$longitude="";
		$address_city=$address_sector=$address_state="";
		$order="ASC";
		$single_room=$twin_single_room=$triple_single_room=$others_pg=$one_rk=$one_room=$two_room=$three_room=$one_bhk=$two_bhk=$three_bhk=$four_bhk=$others_flat="";
		$searchTerm=$select_city=$fully_furnished=$semi_furnished=$unfurnished=$select_owner_free=$select_property_type= $select_ac=$select_available_for=$select_food_inclusive=$select_price=$select_range="";
		$select_range_end="100000"; $select_range_start="10";	
		//$propertyListing = Property::with(['property_descriptions'=> function($query){ $query->select('room_type','description','rent','property_id');}])
		//->with(['property_images'=> function($query){ $query->select('image','property_id');}])->with(['property_addresses'=> function($query){ $query->select('address_house','address_building','zipcode','address_sector','address_city','address_state','property_id');}])
		//->with(['property_details'=> function($query){ $query->select('property_about','property_title','property_type','furnishing','total_room_for_rent','total_bed_for_rent','property_available_men','property_available_unisex','property_available_women','property_available_family','property_id');}])
	 	 $q=Property::query()
		->with(['property_descriptions'=> function($query){ $query->select('rent','room_type','description','property_id');}])
		->with(['property_images'=> function($query){ $query->select('image','property_id');}])->with(['property_addresses'=> function($query){ $query->select('address_house','address_building','zipcode','address_sector','address_city','address_state','property_id');}])
		->with(['property_details'=> function($query){ $query->select('property_about','property_title','property_type','furnishing','total_room_for_rent','total_bed_for_rent','property_available_men','property_available_unisex','property_available_women','property_available_family','property_id');}]);
		$query="";
		if(isset($request->latitude) || $request->latitude!="" )
		{
			$searchTerm=$request->autocomplete;
			$searchTerm=isset($request->autocomplete)? $request->autocomplete : $request->autocomplete_fill;			
			$latitude=$request->latitude;
			$longitude=$request->longitude;
			$distance="5";
			$query.="latitude=".$request->latitude."&longitude=".$request->longitude;
			$raw = \DB::raw('ROUND((111.111 * DEGREES(ACOS(COS(RADIANS('.$latitude.')) * COS(RADIANS(lat)) * COS(RADIANS('.$longitude.' - lng))  + SIN(RADIANS('.$latitude.')) * SIN(RADIANS(lat))))),2) AS distance ');
		
			// $raw = \DB::raw('ROUND ( ( 6371 * acos( cos( radians('.$latitude.') ) * cos( radians( lat ) ) * cos( radians( lng ) - radians('.$longitude.') ) + sin( radians('.$latitude.') ) * sin( radians( lat ) ) ) ) ) AS distance');
			
			$propertyListing = $q->WhereHas('property_addresses', function($q) use ($raw,$distance)  {
			   // Query the name field in status table
			  return  $q->select('*')->addSelect($raw)->orderBy( 'distance', 'DESC' )->having('distance', '<=', $distance);});			  
		}
		if($request->clear_filter == "clear_filter")
		{
			$request->city="chandigarh";
			$query.="&city=".$request->city;
		}
		
		if(isset($request->city) || isset($request->city_filter) || isset($city))
		{
			$city_sel=isset($request->city_filter)? $request->city_filter : isset($request->city)? $request->city : $city;
			if($city_sel=="")
			{
				$city_sel="chandigarh";
			}
			$city=City::where('name',$city_sel)->first();
			$city_id=(($city )? $city->id : 1);
			
			$propertyListing = $q->WhereHas('property_addresses', function($q) use ($city_id)  {
			   // Query the name field in status table
			  return  $q->select('*')->where('address_city', $city_id);});
			$select_city=$request->city;
			$query.="&city=".$request->city;
		}
		
		//if($request->apply_filter == "apply_filter" || isset($request->page))
		//{
			if(isset($request->unfurnished) || (isset($request->semi_furnished)) || (isset($request->fully_furnished)))
			{
					$fur_in=array();
					if(isset($request->unfurnished))
					{
						$unfurnished=$request->unfurnished;
					
						array_push($fur_in,'1');
						//$query.="&unfurnished=".$request->unfurnished;
					}
					
					if(isset($request->semi_furnished))
					{
						$semi_furnished=$request->semi_furnished;
						//$query.="&semi_furnished=".$request->semi_furnished;
						array_push($fur_in,'2');
					}
					
					if(isset($request->fully_furnished))
					{
						$fully_furnished=$request->fully_furnished;
						//$query.="&fully_furnished=".$request->fully_furnished;
						array_push($fur_in,'3');
						
					}
					
					$propertyListing = $q->WhereHas('property_details', function($q) use ($fur_in)  {
						   // Query the name field in status table
						  return  $q->select('*')->whereIn('furnishing', $fur_in);});
						
			}
			
			if(isset($request->property_type))
			{
				$select_property_type=$request->property_type;
				$propertyListing = $q->WhereHas('property_details', function($q) use ($select_property_type)  {
				   // Query the name field in status table
				  return  $q->select('*')->where('property_type', $select_property_type);});
			}
			if(isset($request->property_type))
			{
				$select_property_type=$request->property_type;
				$pro_in=array();		
				if($select_property_type==1)
				{
					if(isset($request->one_rk)) { array_push($pro_in,'5'); $one_rk=$request->one_rk;}					
					if(isset($request->one_room)) { array_push($pro_in,'9'); $one_room=$request->one_room;}
					if(isset($request->two_room)) { array_push($pro_in,'10'); $two_room=$request->$two_room;}
					if(isset($request->three_room)) { array_push($pro_in,'13'); $three_room=$request->three_room;}
					if(isset($request->two_bhk)) { array_push($pro_in,'6'); $two_bhk=$request-$two_bhk;}
					if(isset($request->three_bhk)) { array_push($pro_in,'7'); $three_bhk=$request->three_bhk;}
					if(isset($request->four_bhk)) { array_push($pro_in,'14'); $four_bhk=$request->four_bhk;}
					if(isset($request->others_flat)) {array_push($pro_in,'15'); $others_flat=$request->others_flat;}
					
				}
				elseif($select_property_type==2)
				{				
					if(isset($request->single_room)) { array_push($pro_in,'1'); $single_room=$request->single_room;}
					if(isset($request->twin_single_room)) { array_push($pro_in,'2'); $twin_single_room=$request->twin_single_room;}
					if(isset($request->triple_single_room)){ array_push($pro_in,'3'); $triple_single_room=$request->triple_single_room;}
					if(isset($request->others_pg)) { array_push($pro_in,'4'); $others_pg=$request->others_pg;}	
					
				}
				else
				{
					
				}
				if(count($pro_in)>0)
				 {
					 $propertyListing = $q->WhereHas('property_descriptions', function($q) use ($pro_in)  {
				   // Query the name field in status table
					return  $q->select('*')->whereIn('room_type', $pro_in);});
				 }
			}
			
			if(isset($request->owner_free))
			{
				$select_owner_free=$request->owner_free;
				$query.="&owner_free=".$request->owner_free;
				
				$propertyListing = $q->WhereHas('property_details', function($q) use ($select_owner_free)  {
				   // Query the name field in status table
				  return  $q->select('*')->where('owner_free', $select_owner_free);});
				
			}
			
			if(isset($request->AC))
			{
				$ac=Amenties::where('name','AC')->first();	
				$query.="&AC=".$request->AC;				
				$propertyListing = $q->WhereHas('property_amenities', function($q) use ($ac)  {
				   // Query the name field in status table
				  return  $q->select('*')->where('amenities_id', $ac->id);});
				 $select_ac=$request->AC;
			}
			
			if(isset($request->available_for))
			{
				$text=$request->available_for;	
				$query.="&available_for=".$request->available_for;				
				$propertyListing = $q->WhereHas('property_details', function($q) use ($text)  {
				   // Query the name field in status table
				  return  $q->select('*')->where($text, 1);});
				 $select_available_for=$request->available_for;
			}
			
			if(isset($request->food_inclusive))
			{
				//$food_inclusive=$request->food_inclusive;		
				$query.="&food_inclusive=".$request->food_inclusive;	
				$propertyListing = $q->WhereHas('property_details', function($q) {
				   // Query the name field in status table
				  return  $q->select('*')->where("food_inclusive",1);});
				 $select_food_inclusive=$request->food_inclusive;
			}
			//dd($request);
			if(isset($request->min_price))
			{
				$select_range_start=$request->min_price;
				$select_range_end=$request->max_price;
				if($select_range_end=="100000")
				{
					$select1_range_end=99999;
				}
				else
				{
					$select1_range_end=$select_range_end;
					}
					$query.="&select_range_start=".$request->min_price."&select_range_end=".$request->max_price;				
				$propertyListing = $q->WhereHas('property_descriptions', function($q) use($select_range_start,$select1_range_end) {
				   // Query the name field in status table
				  return  $q->select('*')->whereBetween("rent",[$select_range_start,$select1_range_end]);});
				
			}
			
			if(isset($request->order))
			{
				$order=$request->order;		
				$query.="&order=".$request->order;	
			}
		//}
		$propertyListing = $q->where('status',1)->paginate(20);
		//dd($propertyListing);
		//dd($select_range_start);
		//if ($request->ajax()) {

    	//	$view = view('propertylist',compact('propertyListing'))->render();
           // return response()->json(['html'=>$view,]);
		//	return response()->json(['html'=>$view,'query'=>$query,'latitude'=>$latitude,'longitude'=>$longitude,'searchTerm'=>$searchTerm,'select_city'=>$select_city,'fully_furnished'=>$fully_furnished,'semi_furnished'=>$semi_furnished,'unfurnished'=>$unfurnished,'select_owner_free'=>$select_owner_free,'select_property_type'=>$select_property_type,'select_ac'=>$select_ac,'select_available_for'=>$select_available_for,'select_food_inclusive'=>$select_food_inclusive,'order'=>$order,'select_range_start'=>$select_range_start,'select_range_end'=>$select_range_end,'single_room'=>$single_room,'twin_single_room'=>$twin_single_room,'triple_single_room'=>$triple_single_room,'others_pg'=>$others_pg,'one_rk'=>$one_rk,'one_room'=>$one_room,'two_room'=>$two_room,'three_room'=>$three_room,'one_bhk'=>$one_bhk,'two_bhk'=>$two_bhk,'three_bhk'=>$three_bhk,'four_bhk'=>$four_bhk,'others_flat'=>$others_flat]);

       // }
        return view('propertylist',compact('query','propertyListing','latitude','longitude','searchTerm','select_city','fully_furnished','semi_furnished','unfurnished','select_owner_free','select_property_type','select_ac','select_available_for','select_food_inclusive','order','select_range_start','select_range_end','single_room','twin_single_room','triple_single_room','others_pg','one_rk','one_room','two_room','three_room','one_bhk','two_bhk','three_bhk','four_bhk','others_flat'));
    }

    public function  propertylist_detail(Request $request,$id)
    {
		$amenities=array();
		 $propertyListing = Property::where([['status',1],['property_code',$id]])->with(['property_descriptions'=> function($query){ $query->select('room_type','description','rent','property_id','quantity','security');}])
		->with(['property_images'=> function($query){ $query->select('image','property_id');}])->with(['property_addresses'=> function($query){ $query->select('address_house','address_building','zipcode','address_sector','address_city','address_state','property_id','lat','lng');}])
		->with('property_details')
		->with(['property_amenities'=>function($query){ $query->select('property_id','amenities_id');}])->with(['property_owners'=>function($query){ $query->select('property_id','owner_id');}])
		->with(['property_additional_information'=>function($query){ $query->select('property_id','additional_information');}])
		->with('property_neighbourhood')->first();
		
		if(isset($propertyListing->property_amenities))
		{
			foreach($propertyListing->property_amenities as $key=>$value)
			{	
				$property_amenities=Amenties::where([['id',$value->amenities_id]])->first();			
				$amenities[]=array('name'=>$property_amenities->name,'image'=>$property_amenities->image);
			}
		}
		if($propertyListing)
		{
			return view('propertylist_detail',compact('propertyListing','amenities'));
		}
		else
		{
			return redirect('/');
		}
    }

    public function  about()
    {
        return view('about');
    }

    public function  contact(Request $request)
    {
		if(isset($request->pcode))
		{
			$pcode=$request->pcode;
		}
		else
		{
			$pcode="";
		}
        return view('contact',compact('pcode'));
    }
	
	 protected function validator(array $data)
    {
        return Validator::make($data, [
            'mobilenumber' => ['required','digits:10' ],     
        ],[     
                'mobilenumber.required' => 'Please enter your mobile number',
                'mobilenumber.digits' => 'Please enter valid mobile number.',
           
        ]);
    }

	public function change_mobile_otp_verify(Request $request)
	{	
		$flag=true;
        $this->validator($request->all())->validate();
		$user=User::where('id',Auth::user()->id)->first();
		if($user->mobilenumber==$request->mobilenumber)
		{
			$flag=false;
			return response()->json(['code'=> 201,'error'=> "New Mobile Number will not be same as old Mobile Number"]);
		}
		
		$mobilenumber=$request['mobilenumber'];
		$user=User::where([['id','!=',Auth::user()->id],['mobilenumber',$mobilenumber]])->first();
		if($user)
		{
			$flag=false;
			return response()->json(['code'=> 201,'error'=> "This mobile number is already exits"]);
		}
		if($flag)
		{			
			return response()->json(['code'=> 200,'success'=> "success"]);
		}
	  // $this->guard()->login($user);
		session(['change_number' =>'change_number']);
        // return redirect('/change_mb_otp_verify/'.$mobilenumber);
    }
	
	 public function change_mb_otp_verify(Request $request,$mobile)
    {	
			
		try {
				$key=$_ENV['NEXMO_KEY'];	
				$secret=$_ENV['NEXMO_SECRET'];	
				$brand=$_ENV['NEXMO_BRAND'];	
				
				$basic  = new \Nexmo\Client\Credentials\Basic($key, $secret);
				$client = new \Nexmo\Client($basic);
				
					 $num = $mobile;
					 $numlength = strlen((string)$num);
					if($numlength == 12){
						//dd('12'); die;
						$number = $mobile;
					}else{
						
						$number = '+91'.$mobile;
						}
					
				
				//$response = $client->sms()->send(
					//new \Nexmo\SMS\Message\SMS($number, 'YouLivSpaces', 'Dear '.$phone->name.','.$message)
				//);
				$verification = $client->verify()->start([ 
				  'number' => $number,
				  'brand'  => $brand,
				   'code_length'  => '4']);
				   
				$verification=$verification->getRequestId();
				
				User::where('mobilenumber','=',$mobile)->update(['otp'=>$verification]);
				
				$messages=$warning="";
				//$message = $response->current();
				if ($verification) {
					$messages="OTP is sent to you mobile number";
					
				} else {
					//echo "The message failed with status: " . $message->getStatus() . "\n";
					$messages="The message failed with status: " . $message->getStatus() . "\n";
					//return response()->json(['code'=> 201,'error'=> $messages]);
					
					}
				}
				catch (\Exception $e) {
					// Do what you want here... 
					// Log::error('nexmo failed...');
					 //echo 'Caught exception: ',  $e->getMessage(), "\n";
					 $messages=$e->getMessage();
					// return response()->json(['code'=> 201,'error'=> $messages]);
					// Log::error($e->getMessage());
					// dd($e->getMessage())
				}
				return redirect('/mobile_verify_change/'.$mobile)->with('info',$messages);
        
	}
	  public function mobile_verify_change(Request $request,$mobile){
		$messages=$warning="";
		if($request->isMethod('post'))
		{
			$messages=$warning="";
			try {
				
				$key=$_ENV['NEXMO_KEY'];	
				$secret=$_ENV['NEXMO_SECRET'];	
				$brand=$_ENV['NEXMO_BRAND'];	
				$basic  = new \Nexmo\Client\Credentials\Basic($key, $secret);
				$client = new \Nexmo\Client($basic);
				
				$user= User::where('id',Auth::user()->id)->first();
				$request_id = $user->otp;
				
				//$verification = new \Nexmo\Verify\Verification($request_id);
				//$result = $client->verify()->check($request_id, $request->otp);		
				
				
				User::where('id',Auth::user()->id)->update(['mobilenumber'=>$request['mobilenumber']]);
				$messages="Phone number successfully changed!";
					
				return redirect('my_account')->with('success', $messages); 	
			}
			catch (\Exception $e) {
					// Do what you want here... 
					// Log::error('nexmo failed...');
					 //echo 'Caught exception: ',  $e->getMessage(), "\n";
					 $warning= "Verification failed with status " . $e->getCode()
        . " and error text \"" . $e->getMessage() . "\"\n";
					// Log::error($e->getMessage());
					// dd($e->getMessage())
			}
			 return view('mobile_verify_change',['mobilenumber'=>$mobile,'messages'=>$messages,'warning'=>$warning]);
		}
		else
		{
			
			return view('mobile_verify_change',['mobilenumber'=>$mobile,'messages'=>$messages,'warning'=>$warning]);
		}
		
		
	}
    public function  myaccount(Request $request)
    {
		$user=User::where('id',Auth::user()->id)->first();
		

		if($request->isMethod('post'))
		{
		
		 $request->validate([
			'name' => 'required|string|max:255',
			// 'pay_loc' => 'required',
			'email' => 'required|string|email|max:255|unique:users,email,'.Auth::user()->id,
			//'mobilenumber' => 'required|string|max:255|unique:users,mobilenumber,'.Auth::user()->id,
		
		  ],[],[

		  ]);
			$data=request()->except(['_token']);	
			if (request()->hasFile('image')){

				if (File::exists('public/profileimage/'.$user->image))
				{
					unlink('public/profileimage/'.$user->image);
				}				
				 $image = $request->file('image');
				$token = Str::random(10);
				$name = time().'_'.$token.'.'.$image->getClientOriginalExtension();
				$destinationPath = 'public/profileimage/';
				$image->move($destinationPath, $name);
			
				$data['image']=$name;
			}
			
			
			$user=User::where('id',Auth::user()->id)->update($data);
			
			if($user)
			{
				return redirect('/my_account/')->with('success',"Profile updated successfully");
			}
			else
			{
				return redirect('/my_account/')->with('error',"Error occuered while updating profile");
			}
		}
		else
		{
			$coming_schedule=Schedule::where([['user_id',Auth::user()->id],['visit_time','>=', date('Y-m-d H:i:s')]])->with('property_details')->with('property_address')->with(['property_images'=>function($query) {
			return $query->limit(1);}])->with('property')->get();
			
			$past_schedule=Schedule::where([['user_id',Auth::user()->id],['visit_time','<=', date('Y-m-d H:i:s')]])->with('property_details')->with('property_address')->with(['property_images'=>function($query) {
			return $query->limit(1);}])->with('property')->get();
			
			$fav_list=Favorite::where([['user_id',Auth::user()->id]])->with('property_details')->with('property_address')->with(['property_images'=>function($query) {
			return $query->limit(1);}])->with('property')->get();
			
			
			return view('profile',compact('user','coming_schedule','past_schedule','fav_list'));
		}
		
       
    }
    
  
    public function  notification()
    {
        return view('notification');
    }
    
    public function  payment()
    {
        return view('payment');
    }
    

    public function  subscription()
    {
        return view('schedule_visit');
    }

    
    public function  schedule_visit()
    {
        return view('schedule_visit');
    }
	
	public function  googlelatlong()
    {
		$city=City::get();
		//foreach()
		//{
			
		//}
		$find="sector+80,mohali,punjab";
		$json = file_get_contents("https://maps.googleapis.com/maps/api/geocode/json?address=".$find."&key=AIzaSyDNB522DKb2l2rwmHv4zcL7OgGEM-b5_cA");
		$json = json_decode($json,true);
		dd($json['results'][0]['geometry']['location']);
	}

    public function contact_mail_send(Request $request)
    {  
		
		    $this->validate($request, [ 'name' => 'required', 'email' => 'required|email', 'message' => 'required' ]);
			//ContactUS::create($request->all()); 
			//$to=$form="akulmahajan2@gmail.com";
			$to=$from="mandeep.teja23@gmail.com";
			  
		   if($request->pcode)
		   {
			  
				Mail::send('property_contact',
				   array(
					   'name' => $request->get('name'),
					   'email' => $request->get('email'),
					   'phone' => $request->get('phone'),
					   'property_code' => $request->pcode,
					   'user_message' => $request->get('message')
				   ), function($message)
			   {
				   $message->from("akulmahajan2@gmail.com");
				   $message->to("akulmahajan2@gmail.com", 'YouLivSpaces')->subject('Property Inquery From Submitted');
			   });
			   
		   }
		   else
		   {
			  
			   Mail::send('contact_us',
				   array(
					   'name' => $request->get('name'),
					   'email' => $request->get('email'),
					   'phone' => $request->get('phone'),
					   'user_message' => $request->get('message')
				   ), function($message)
			   {
				   $message->from("akulmahajan2@gmail.com");
				   $message->to("akulmahajan2@gmail.com", 'YouLivSpaces')->subject('Contact From Submitted');
			   });
		   }
		   
		   
		 
			return back()->with('success', 'Thanks for contacting us!'); 
	}
	
	 public function getCityInfo($id)
    {
        $cities = city::where('state_id', '=', $id)->get();
        $cities =  json_decode(json_encode($cities), true);
        return response()->json($cities);
    }
    public function getSectorInfo($id)
    {
        $cities = Sector::where('city_id', '=', $id)->get();
        $cities =  json_decode(json_encode($cities), true);
        return response()->json($cities);
    }

	public function property_listing_request(Request $request)
	{
		
		$state = State::get();
        $sector = Sector::get();
        $city = City::get();
		$owner="";
        $amenity = Amenties::orderBy('id', 'asc')->get();
		
		if(isset(Auth::guard('property_owner')->user()->id))
		{		
			$owner=Owner::where('id',Auth::guard('property_owner')->user()->id)->first();			
		}
		
		if($request->isMethod('post'))
		{
			$propertyDetail = new PropertyRequestDetail();
			
			//Property Detail
            $propertyDetail->property_type    =  ($request->property_type)?$request->property_type:1 ;
			$propertyDetail->water_inclusive = $request->water_inclusive ;
			$propertyDetail->property_title = $request->property_title ;
			$propertyDetail->property_about = $request->property_about ;
            $propertyDetail->property_available_men =  ($request->property_available_men=="on")?1:0 ;
			$propertyDetail->property_available_women = ($request->property_available_women =="on")?1:0 ;
			$propertyDetail->property_available_unisex = ($request->property_available_unisex=="on")?1:0 ;
			$propertyDetail->property_available_family = ($request->property_available_family =="on")?1:0 ;
            $propertyDetail->furnishing       =  ($request->furnishing)?$request->furnishing: 1 ;
            $propertyDetail->owner_free      =  ($request->owner_free)?$request->owner_free: 1 ;
            $propertyDetail->total_room_for_rent  = ($request->total_room_for_rent)?$request->total_room_for_rent: null ;
            $propertyDetail->amenities_others_text   = ($request->amenities_others_text )?$request->amenities_others_text : null ;
            $propertyDetail->total_bed_for_rent   = ($request->total_bed_for_rent)?$request->total_bed_for_rent: null ;
            $propertyDetail->amenities_others       =  ($request->amenities_others)?$request->amenities_others: 0 ;
            $propertyDetail->food_inclusive       =  ($request->food_inclusive)?$request->food_inclusive: 1 ;
			$propertyDetail->food_exclusive       =  ($request->food_exclusive)?$request->food_exclusive: 2 ;
            $propertyDetail->electricity_inclusive  = ($request->electricity_inclusive)?$request->electricity_inclusive: 1 ;
            $propertyDetail->food_exclusive_rent  = ($request->food_exclusive_price)?$request->food_exclusive_price: null ;
			$propertyDetail->request_status  = 0;
			
			//owner
            $propertyDetail->owner_name  = ($request->owner_name)?$request->owner_name: null ;
            $propertyDetail->owner_number  = ($request->owner_number)?$request->owner_number: null ;
            $propertyDetail->alernate_number  = ($request->alernate_number)?$request->alernate_number: null ;
			if(isset(Auth::guard('property_owner')->user()->id))
			{
				$propertyDetail->owner_id  = Auth::guard('property_owner')->user()->id;
				$propertyDetail->request_status  = 1;
			}
			
			//Address
			$propertyDetail->address_house = ($request->address_house)?$request->address_house:Null;
			$propertyDetail->address_building = ($request->address_building)?$request->address_building:Null;
			$propertyDetail->address_street = ($request->address_street)?$request->address_street:Null;
			$propertyDetail->address_sector = ($request->address_sector)?$request->address_sector:Null;
			$propertyDetail->address_city = ($request->address_city)?$request->address_city:Null;
			$propertyDetail->address_state = ($request->address_state)?$request->address_state:Null;
			$propertyDetail->zipcode = ($request->zipcode)?$request->zipcode:Null;
			
			
			//Property Lease
			 if (!empty($request->lease_deed)) {
				$lease_deed = $request->owner_name . '_' . time() . '.' . request()->lease_deed->getClientOriginalExtension();
				$path = 'assets/img/lease_deed';
				request()->lease_deed->move(public_path($path), $lease_deed);
				$OwnerLeaseDeedImage =  'public/'.$path . '/' . $lease_deed;
			}else{
				$OwnerLeaseDeedImage = Null;
			}

			if (!empty($request->property_address_img)) {
				$property_address_img = $request->owner_name . '_' . time() . '.' . request()->property_address_img->getClientOriginalExtension();
				$path = 'assets/img/lease_deed';
				request()->property_address_img->move(public_path($path), $property_address_img);
				$OwnerDiffrentAddrImage =  'public/'.$path . '/' . $property_address_img;
			}else{
				$OwnerDiffrentAddrImage = Null;
			}
			
			$propertyDetail->property_owned = ($request->property_owned)?$request->property_owned:1;
			$propertyDetail->lease_unit = ($request->lease_unit)?$request->lease_unit:Null;
			$propertyDetail->lease_duration = ($request->lease_duration)?$request->lease_duration:Null;
			$propertyDetail->lease_expiry = ($request->lease_expiry)?$request->lease_expiry:Null;
			$propertyDetail->lease_deed= $OwnerLeaseDeedImage;
			$propertyDetail->id_proof_is_same_address = ($request->id_proof_address)?$request->id_proof_address:2;
			$propertyDetail->property_diff_address = ($request->property_diff_address)?$request->property_diff_address:Null;
			$propertyDetail->property_address_img = $OwnerDiffrentAddrImage;
			
			//Area distance
			$propertyDetail->area1 = ($request->area1)?$request->area1:null;
			$propertyDetail->distance1 = ($request->distance1)?$request->distance1:null;
			$propertyDetail->area2 = ($request->area2)?$request->area2:null;
			$propertyDetail->distance2 = ($request->distance2)?$request->distance2:null;
			$propertyDetail->area3 = ($request->area3)?$request->area3:null;
			$propertyDetail->distance3 = ($request->distance3)?$request->distance3:null;
			$propertyDetail->area4 = ($request->area4)?$request->area1:null;
			$propertyDetail->distance4 = ($request->distance4)?$request->distance4:null;
			
			
			$propertyDetail->save();
			$property_id = $propertyDetail->id;
		
			//Description
			 if(isset($request->room_type))
			{
				

				if (in_array("single_sharing", $request->room_type)) {
					$PropertyDescription = new PropertyRequestDescription();					
					$PropertyDescription->property_id     = $property_id;
					$PropertyDescription->room_type     = 1;
					$PropertyDescription->quantity      = $request->single_sharing_quantity;
					$PropertyDescription->rent          = $request->single_sharing_rent;
					$PropertyDescription->security      = $request->single_sharing_security;
					$PropertyDescription->description   = $request->single_sharing_description;

					$Property_description_id = $PropertyDescription->save();
				}

				if (in_array("twin_sharing", $request->room_type)) {

				    $PropertyDescription = new PropertyRequestDescription();					
					$PropertyDescription->property_id     = $property_id;
					$PropertyDescription->room_type = 2;
					$PropertyDescription->quantity = $request->twin_sharing_quantity;
					$PropertyDescription->rent = $request->twin_sharing_rent;
					$PropertyDescription->security = $request->twin_sharing_security;
					$PropertyDescription->description = $request->twin_sharing_description;
					$Property_description_id = $PropertyDescription->save();
				}

				if (in_array("triple_sharing", $request->room_type)) {

				    $PropertyDescription = new PropertyRequestDescription();					
					$PropertyDescription->property_id     = $property_id;
					$PropertyDescription->room_type = 3;
					$PropertyDescription->quantity = $request->triple_sharing_quantity;
					$PropertyDescription->rent = $request->triple_sharing_rent;
					$PropertyDescription->security = $request->triple_sharing_security;
					$PropertyDescription->description = $request->triple_sharing_description;

					$Property_description_id = $PropertyDescription->save();
				}

				if (in_array("other", $request->room_type)) {

				    $PropertyDescription = new PropertyRequestDescription();					
					$PropertyDescription->property_id     = $property_id;
					$PropertyDescription->room_type = 4;
					$PropertyDescription->quantity = $request->other_room_quantity;
					$PropertyDescription->rent = $request->other_room_rent;
					$PropertyDescription->security = $request->other_room_security;
					$PropertyDescription->description = $request->other_room_description;

					$Property_description_id = $PropertyDescription->save();
				}
			}
			if(isset($request->flat_type))
			{
	
				if (in_array("one_room", $request->flat_type)) {
					$PropertyDescription = new PropertyRequestDescription();					
					$PropertyDescription->property_id     = $property_id;
					$PropertyDescription->room_type = 9;
					$PropertyDescription->quantity = $request->one_room_quantity;
					$PropertyDescription->rent = $request->one_room_rent;
					$PropertyDescription->security = $request->one_room_security;
					$PropertyDescription->description = $request->one_room_description;

					$Property_description_id = $PropertyDescription->save();
				}
				if (in_array("two_room", $request->flat_type)) {
					$PropertyDescription = new PropertyRequestDescription();					
					$PropertyDescription->property_id     = $property_id;
					$PropertyDescription->room_type = 10;
					$PropertyDescription->quantity = $request->two_room_quantity;
					$PropertyDescription->rent = $request->two_room_rent;
					$PropertyDescription->security = $request->two_room_security;
					$PropertyDescription->description = $request->two_room_description;

					$Property_description_id = $PropertyDescription->save();
				}
				if (in_array("three_room", $request->flat_type)) {
					$PropertyDescription = new PropertyRequestDescription();
					$PropertyDescription->property_id     = $property_id;
					$PropertyDescription->room_type = 13;
					$PropertyDescription->quantity = $request->three_room_quantity;
					$PropertyDescription->rent = $request->three_room_rent;
					$PropertyDescription->security = $request->three_room_security;
					$PropertyDescription->description = $request->three_room_description;

					$Property_description_id = $PropertyDescription->save();
				}

				if (in_array("one_rk", $request->flat_type)) {
					$PropertyDescription = new PropertyRequestDescription();					
					$PropertyDescription->property_id     = $property_id;
					$PropertyDescription->room_type = 5;
					$PropertyDescription->quantity = $request->one_rk_quantity;
					$PropertyDescription->rent = $request->one_rk_rent;
					$PropertyDescription->security = $request->one_rk_security;
					$PropertyDescription->description = $request->one_rk_description;

					$Property_description_id = $PropertyDescription->save();
				}


				if (in_array("one_bhk", $request->flat_type)) {
					$PropertyDescription = new PropertyRequestDescription();					
					$PropertyDescription->property_id     = $property_id;
					$PropertyDescription->room_type = 6;
					$PropertyDescription->quantity = $request->one_bhk_quantity;
					$PropertyDescription->rent = $request->one_bhk_rent;
					$PropertyDescription->security = $request->one_bhk_security;
					$PropertyDescription->description = $request->one_bhk_description;

					$Property_description_id = $PropertyDescription->save();
				}

				if (in_array("two_bhk", $request->flat_type)) {
					$PropertyDescription = new PropertyRequestDescription();
					$PropertyDescription->property_id     = $property_id;
					$PropertyDescription->room_type = 7;
					$PropertyDescription->quantity = $request->two_bhk_quantity;
					$PropertyDescription->rent = $request->two_bhk_rent;
					$PropertyDescription->security = $request->two_bhk_security;
					$PropertyDescription->description = $request->two_bhk_description;

					$Property_description_id = $PropertyDescription->save();
				}

				if (in_array("three_bhk", $request->flat_type)) {
					$PropertyDescription = new PropertyRequestDescription();					
					$PropertyDescription->property_id     = $property_id;
					$PropertyDescription->room_type = 14;
					$PropertyDescription->quantity = $request->three_bhk_quantity;
					$PropertyDescription->rent = $request->three_bhk_rent;
					$PropertyDescription->security = $request->three_bhk_security;
					$PropertyDescription->description = $request->three_bhk_description;

					$Property_description_id = $PropertyDescription->save();
				}
				if (in_array("four_bhk", $request->flat_type)) {
					$PropertyDescription = new PropertyRequestDescription();					
					$PropertyDescription->property_id     = $property_id;
					$PropertyDescription->room_type = 15;
					$PropertyDescription->quantity = $request->four_bhk_quantity;
					$PropertyDescription->rent = $request->four_bhk_rent;
					$PropertyDescription->security = $request->four_bhk_security;
					$PropertyDescription->description = $request->four_bhk_description;

					$Property_description_id = $PropertyDescription->save();
				}
				if (in_array("flat_other", $request->flat_type)) {
				    $PropertyDescription = new PropertyRequestDescription();					
					$PropertyDescription->property_id     = $property_id;
					$PropertyDescription->room_type = 8;
					$PropertyDescription->quantity = $request->other_flat_quantity;
					$PropertyDescription->rent = $request->other_flat_rent;
					$PropertyDescription->security = $request->other_flat_security;
					$PropertyDescription->description = $request->other_flat_description;

					$Property_description_id = $PropertyDescription->save();
				}
				
				
				/*
				//Property Lease
				 if (!empty($request->file('files'))) {
					$images = $request->file('files');
					$path = 'assets/img/property_images';

					$list=array();
					$i=0;
					foreach ($images as $image) {

						//$input['imagename'] = time().'.'.$image->getClientOriginalExtension();
						$getImageName = time() . '_'.$i.'.' . $image->getClientOriginalExtension();

						$targetFilePath = public_path($path);
						//$image->move($targetFilePath, $getImageName);
						$img = Image::make($image->getRealPath());
						$img->resize(700, 500);
						$img->insert(public_path('app_asset/images/watermark.png'), 'bottom-right', 20, 20)->save($targetFilePath.'/'.$getImageName);
						//$image->move($path, $getImageName);
						$savepathImageName="public/assets/img/property_images".'/'.$getImageName;
						array_push($list,$savepathImageName);
						$i++;
					}

				}*/
            }
			//amenities
				
				 if (!empty($request->amenities)) {
                $amenities = $request->amenities;				

					foreach ($amenities  as $ammenity) {
						$propertyAmenities = new PropertyRequestAmenities();
						$propertyAmenities->property_id = $property_id;
						$propertyAmenities->amenities_id = $ammenity;
						$propertyAmenities->save();
					}
				}
			
		}
        return view("property_listing_request", compact('sector','state','city','amenity','owner'));		

	}
}
