<?php

namespace App\Services;
use App\SocialIdentities;
use App\User;
use Laravel\Socialite\Contracts\User as ProviderUser;
use Session;
use App\UserTypes;
use App\UserDetails;
use Illuminate\Support\Str;
use Auth;
use App\Schedule;
class SocialGoogleAccountService 
{
	public function __construct() {
		//$this->get_user_type_id = app('App\Http\Controllers\Controller');
	}
	
    public function createOrGetUser(ProviderUser $providerUser)
    {
		
        $account = SocialIdentities::whereProviderName('google')
            ->whereProviderId($providerUser->getId())
            ->first();
			if ($account) {
						return $account->user;
					} else {
			$account = new SocialIdentities([
                'provider_id' => $providerUser->getId(),
                'provider_name' => 'google'
				
            ]);
			
				$user = User::whereEmail($providerUser->getEmail())->first();
				if (!$user) {
				//$user_type=Session::put('user_type');				
				//$user_type_id = $user_type = $this->get_user_type_id($user_type);			
				
				$user = User::create([
                    'email' => $providerUser->getEmail(),
					'user_name' => $providerUser->getEmail(),
                    'name' => $providerUser->getName(),
                   // 'package_id' => 1,
                   // 'is_active' => 1,
                   'is_mobile_verified' => 1,
                    'password' => '',
                ]);
				$url = $providerUser->getAvatar();	
				
				$url=str_replace("s96-c", "s208-c", $url);
			
				$fcontent = file_get_contents($url);
				
				if($fcontent)
				{
					$token = Str::random(10);
					$name = time().'_'.$providerUser->getId().'.jpg';
					$file = fopen(public_path().'/profileimage/'.$name, 'w+');
					fputs($file, $fcontent);
					fclose($file);
				}
				$data=array('email_verified_at' => date('Y-m-d h:i:s'),'image'=>$name,'is_active'=>1);
				
				User::where('id',$user->id)->update($data);
				$user = User::whereEmail($providerUser->getEmail())->first();
				
				//$data1['fname']=$providerUser->getName();
				
				//$data1['user_id']=$user->id;
				//UserDetails::create($data1);
            }
   
			$account->user()->associate($user);
						$account->save();
			return $user;
					}
    }
	
	public function get_user_type_id($type)
    {
        if(strtolower($type)== 'admin' || strtolower($type) == 'stylist' || strtolower($type) == 'client'){
                $user_type = $type;
		}else {
			$user_type = 'client';
		}
		
		$user_type_exists=UserTypes::where('type_name',$user_type)->first();
		
		if($user_type_exists)
		{
			$allowed_user_type_id=$user_type_exists->id;
		}
		else{
			$allowed_user_type_id=0;
		}
        return $allowed_user_type_id;
    }
}
