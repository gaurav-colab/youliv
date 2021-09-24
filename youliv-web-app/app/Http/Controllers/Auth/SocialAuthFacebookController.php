<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Socialite;
use App\Services\SocialFacebookAccountService;
use Session;
use App\Schedule;
class SocialAuthFacebookController extends Controller
{
    /**
   * Create a redirect method to facebook api.
   *
   * @return void
   */
    public function redirect()
    {
		
        return Socialite::driver('facebook')->stateless()->redirect();
    }
    /**
     * Return a callback method from facebook api.
     *
     * @return callback URL from facebook
     */
    public function callback(SocialFacebookAccountService $service)
    {
		
        $user = $service->createOrGetUser(Socialite::driver('facebook')->stateless()->user());
         if($user->is_active == 1) {
            auth()->login($user);
			if(session('sh_id')!=NULL)
			{
				$sh_create=Schedule::where('id',session('sh_id'))->update(array('user_id'=>$user->id));
				$messages="Your schedule for property visit successfully added.!";
				session()->forget('sh_id');		
				return redirect()->to('my_account')->with('success', $messages);				
			}
			else if(session('pro_id')!=NULL)
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
			else
			{
				return redirect()->to('my_account');
			}
        }else{
            return redirect()->to('login');
        }

    }
}
