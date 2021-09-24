<?php

namespace App\Http\Controllers\Property_owner;

use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\ThrottlesLogins;

class OwnerController extends Controller
{
    public function __construct(){
    }
    public function change_password(){
        return view("property_owner.change_password");
    }
    public function submit_change_password(Request $request){
        
        $user = Auth::guard('property_owner')->user();
        
        

        $this->validator($request);

        if (Hash::check($request->old_password, $user->password)) { 
            $user->fill([
             'password' => Hash::make($request->new_password)
             ])->save();
         
            $request->session()->flash('success', 'Password changed successfully');
             return redirect()->route('property_owner.change_password');
         
         } else {
             $request->session()->flash('error', 'Password does not match');
             return redirect()->route('property_owner.change_password');
         }
    }

    /**
     * Validate the form data.
     *
     * @param \Illuminate\Http\Request $request
     * @return
     */
    private function validator(Request $request)
    {
        $rules = [
            'old_password'   => 'required',
            'new_password' => ['required', 'string', 'min:8','max:20','regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*(_|[^\w])).+$/'],'|different:password',
            // Should have at least 1 lowercase AND 1 uppercase AND 1 number AND 1 symbol
            'confirm_password' =>['required','string', 'min:8','max:20','same:new_password'],
        ];

        //custom validation error messages.
        $messages = [
            'new_password.min' => ' Password must be atleast 8 character long',
            'new_password.max' => ' Password must be atmost 20 character long',
            'new_password.regex' => ' Password must contain at least 1 lowercase,1 uppercase, 1 numeric, 1 special character ',
            'confirm_password.same' => ' Password and confirmation Password doesnot Match',
            
        ];

        //validate the request.
        $request->validate($rules,$messages);
    }
}
