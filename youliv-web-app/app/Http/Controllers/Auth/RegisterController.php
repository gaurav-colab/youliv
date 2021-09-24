<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Auth;
use App\Schedule;
//use sendotp\sendotp;
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    //protected $redirectTo = RouteServiceProvider::HOME;
		protected $redirectTo = '/mobile_verify';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');		
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'mobilenumber' => ['required','digits:10','unique:users'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required',  'email', 'unique:users','regex:/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/' ],
            'password' => ['required', 'string', 'min:8','max:20','regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*(_|[^\w])).+$/'],
            // Should have at least 1 lowercase AND 1 uppercase AND 1 number AND 1 symbol

            'gender' => ['required','string'],
            'confirm_password' =>['required','string', 'min:8','max:20','same:password'],
           
        ],[     
                'mobilenumber.required' => 'Please enter your mobile number',
                'mobilenumber.digits' => 'Please enter valid mobile number.',
               
                
                'name.required' => ' Please enter your full name',
                
                'email.required' => ' Please enter your email address',
                'email.regex' => ' Please enter a valid email address',
                'confirm_password.required' => ' Please re-enter the same password',
                'password.min' => ' Password must be atleast 8 character long',
                'password.max' => ' Password must be atmost 20 character long',
                'confirm_password.same' => ' Password and confirmation Password doesnot Match',
                'password.required' => ' Please enter a password',
                'password.regex' => ' Password must contain at least 1 lowercase,1 uppercase, 1 numeric, 1 special character ',
                'gender.required' => ' The  gender  is required.',
           
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {

        $random = "0000";

        $createArray = array(

            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'mobilenumber' => $data['mobilenumber'],
            'gender' => $data['gender'],
            'otp' => '0000',
            'is_mobile_verified' => 1,
			'is_active' => 1,
        );

       //echo "<pre>"; print_r($createArray);  echo "</pre>"; die('sdfsd');
       //auth()->login($user);
        return User::create($createArray);

     //  Auth::login($user);
	   
	//  return $user;
      //  if(!empty($createArray)){
           //return redirect()->to('/mobile_verify');
       // echo "<pre>"; print_r("hello");  echo "</pre>"; 
      //  return view('mobile_verify',['mobilenumber'=>$data['mobilenumber'],'otp'=>'otp']);
        //}
        
       
        
    }
	 public function register(Request $request)
    {	
        $this->validator($request->all())->validate();
		$data=$request->all();			
        event(new Registered($user = $this->create($data)));
		
		
		//$data["user_id"]=$user->id;
		$mobilenumber=$request['mobilenumber'];
	   $this->guard()->login($user);
		return redirect('/my_account');
        // return redirect('/submitmobile_otp_verify/'.$mobilenumber);
    }
    public function mobile_verify(Request $request,$mobile){
		$messages=$warning="";
		if($request->isMethod('post'))
		{
			$messages=$warning="";
			try {
				$basic  = new \Nexmo\Client\Credentials\Basic('b35e723c', 'yvn7FslhQcktMgk8');
				$client = new \Nexmo\Client($basic);
				
				$user= User::where('mobilenumber','=',$request['mobilenumber'])->first();
				if($user)
				{	
					$num = $mobile;
					$numlength = strlen((string)$num);
					if($numlength == 12){
					//dd('12'); die;
						$number = $mobile;
					}else{

					$number = '+91'.$mobile;
					}			
					
					//$result=Msg91::otp($request['otp']) // OTP to be verified
				//	->to($number) // phone number with country code
					//->verify(); // Verify	

					dd($result);					
					$messages="Verification successful. Welcome to the YouLivSpaces";
					User::where('mobilenumber','=',$mobile)->update(['is_mobile_verified'=>1,'is_active'=>1]);
				
				$this->guard()->login($user);
				//dd(session('sh_id'));dd($user);
				if(session('sh_id')!=NULL)
				{
					$sh_create=Schedule::where('id',session('sh_id'))->update(array('user_id'=>Auth::user()->id));
					$messages="Your schedule for property visit successfully added.!";
					session()->forget('sh_id');
					
				}				
					return redirect('my_account')->with('success', $messages); 	
				}
			}
			catch (\Craftsys\Msg91\Exceptions\ValidationException $e) {
				 $warning=$e->getMessage();
			} catch (\Craftsys\Msg91\Exceptions\ResponseErrorException $e) {
				 $warning=$e->getMessage();
			} catch (\Exception $e) {
				 $warning=$e->getMessage();
			}
			 return view('mobile_verify',['mobilenumber'=>$mobile,'messages'=>$messages,'warning'=>$warning]);
		}
		else
		{
			
			return view('mobile_verify',['mobilenumber'=>$mobile,'messages'=>$messages,'warning'=>$warning]);
		}
		
		
	}
    public function mobile_otp_verify(){

		$client = new Vonage\Client(new Vonage\Client\Credentials\Basic(API_KEY, API_SECRET));   

		return view('auth.passwords.mobile_verify');
      
    }


    public function submitmobile_otp_verify(Request $request,$mobile)
    {	
					
		try {
				
				$num = $mobile;
				$numlength = strlen((string)$num);
				if($numlength == 12){
				//dd('12'); die;
					$number = $mobile;
				}else{

					$number = '+91'.$mobile;
				}
					//$client = new Client($config);
				//$result=$client->otp()
					//->to($number) // phone number with country code
					//->template('5faa46d3e4a98d3fd02756db') // set the otp template
				//	->send(); // send the otp
				////$otp = new sendotp('346775AiCJkSeiZ5faa21bbP1','Message Template : My otp is {{otp}}. Please do not share Me.');
				//User::where('mobilenumber','=',$mobile)->update(['otp'=>$verification]);
				////$result=$otp->send($number, 'YOULIVSP');
				dd($result);
				$messages=$warning="";
				//$message = $response->current();
				if ($$result) {
					$messages="OTP is sent to you mobile number";
				} else {					
					$messages="The message failed with status: " . $message->getStatus() . "\n";					
				}
			}
			 catch (\Craftsys\Msg91\Exceptions\ValidationException $e) {
				 $messages=$e->getMessage();
			} catch (\Craftsys\Msg91\Exceptions\ResponseErrorException $e) {
				 $messages=$e->getMessage();
			} catch (\Exception $e) {
				 $messages=$e->getMessage();
			}
			return redirect('/mobile_verify/'.$mobile)->with('info',$messages);
        
	}
	
}


