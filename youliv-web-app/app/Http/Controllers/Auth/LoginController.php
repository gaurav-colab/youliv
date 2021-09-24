<?php

namespace App\Http\Controllers\Auth;
use \Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use App\Schedule;
use App\Favorite;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
   // protected $redirectTo = RouteServiceProvider::HOME;
protected $redirectTo = '/my_account';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
	
	protected function credentials(Request $request)
        {
          if(is_numeric($request->get('email'))){
            return ['mobilenumber'=>$request->get('email'),'password'=>$request->get('password'), 'is_active' => 1];
          }
          elseif (filter_var($request->get('email'), FILTER_VALIDATE_EMAIL)) {
            return ['email' => $request->get('email'), 'password'=>$request->get('password'), 'is_active' => 1];
          }
          return ['username' => $request->get('email'), 'password'=>$request->get('password'), 'is_active' => 1];
        }
    protected function sendLoginResponse(Request $request)
	{
    // ...
	
		if(session('sh_id')!=NULL)
		{
			$sh_create=Schedule::where('id',session('sh_id'))->update(array('user_id'=>Auth::user()->id));
			session()->forget('sh_id');		
			return redirect('my_account')->with('success', 'Your schedule for property visit successfully added.!'); 
		}
		
		if(session('pro_id')!=NULL)
		{
			$sh_create=Favorite::where([['property_id',session('pro_id')],['user_id',Auth::user()->id]])->with('property')->first();
			$url=session('url');
			if($sh_create)
			{
				$msg='This Property is already added in your favorite list!'; 
			}
			else{					
				$msg='Property successfully added into your favorite list!'; 
			}
			
			$sh_create=Favorite::where([['property_id',session('pro_id')],['user_id',Auth::user()->id]])->with('property')->first();
			
			$url=session('url');
			
			$data['property_id']=session('pro_id');
			$data['user_id']=Auth::user()->id;
			$sh_create=Favorite::create($data);
			session()->forget('pro_id');	session()->forget('url');
			//$property=Favorite::where([['id',$sh_create->id]])->with('property')->first();				
			return redirect($url)->with('success', $msg);
			
			
			
		}
		return $this->authenticated($request, $this->guard()->user())
            ?: redirect()->intended($this->redirectPath());
	}
    

}
