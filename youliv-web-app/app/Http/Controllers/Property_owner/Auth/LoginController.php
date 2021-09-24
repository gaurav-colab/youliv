<?php

namespace App\Http\Controllers\Property_owner\Auth;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;

class LoginController extends Controller
{
    use ThrottlesLogins;
    /**
     * Show the login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return view('property_owner.auth.login',[
            'title' => 'Property Owner Login',
            'loginRoute' => 'property_owner.login',
            'forgotPasswordRoute' => 'property_owner.password.request',
        ]);
    }

    /**
     * Login the Property owner.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */

    public function login(Request $request){
        $this->validator($request);

        //check if the user has too many login attempts.
        if ($this->hasTooManyLoginAttempts($request)){
            //Fire the lockout event
            $this->fireLockoutEvent($request);

            //redirect the user back after lockout.
            return $this->sendLockoutResponse($request);
        }

        //attempt login.
        if(Auth::guard('property_owner')->attempt($request->only('owner_number','password'),$request->filled('remember'))){
            //Authenticated, redirect to the intended route
            //if available else admin dashboard.
            return redirect()
                ->intended(route('property_owner.home'))
                ->with('status','You are Logged in as Admin!');
        }

        //keep track of login attempts from the user.
        $this->incrementLoginAttempts($request);

        //Authentication failed, redirect back with input.
        $request->session()->flash('error', 'Invalid login details');
        return $this->loginFailed();
    } 

    /**
     * Validate the form data.
     *
     * @param \Illuminate\Http\Request $request
     * @return
     */
    private function validator(Request $request)
    {
        //validation rules.
        $rules = [
            'owner_number'    => 'required|exists:owners|min:5|max:191',
            'password' => 'required|string|min:4|max:255',
        ];

        //custom validation error messages.
        $messages = [
            'owner_number.required' => 'The mobile number field is required.',
            'owner_number.exists' => 'These credentials do not match our records.',
        ];

        //validate the request.
        $request->validate($rules,$messages);
    }

    /**
     * Redirect back after a failed login.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    private function loginFailed(){

        
        return redirect()
            ->back()
            ->withInput()
            ->with('error','Login failed, please try again!');
    }
    /**
     * Logout the admin.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        Auth::guard('property_owner')->logout();
        return redirect()
            ->route('property_owner.login')
            ->with('status','Admin has been logged out!');
    }
    /**
     * Username used in ThrottlesLogins trait
     *
     * @return string
     */
    public function username(){
        return 'email';
    }
}
