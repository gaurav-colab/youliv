<?php

namespace App\Http\Controllers\admin;

use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use DataTables;
use Validator;
use Exception;
use Session;
use App\User;
use App\PropertyOwnerBankDetails;
use Illuminate\Support\Facades\Hash;
Use File;
use Illuminate\Support\Str;
class UserController extends Controller
{

    //
    public function __construct()
    {
    }
	public function owner_payment_detail_approval()
	{	 
	   $owner_detail=PropertyOwnerBankDetails::with('owner')->get();
	   //dd($owner_detail);
	   return view('admin.user.owner_payment_detail_approval',compact('owner_detail'));
	}	
	public function index()
	{	 
	   $user=User::get();
	   return view('admin.user.index',compact('user'));
	}	
   public function update(Request $request,$id)
    {
        $user=User::where('id',$id)->first();
		

		if($request->isMethod('post'))
		{
		
		 $request->validate([
			'name' => 'required|string|max:255',
			// 'pay_loc' => 'required',
			'email' => 'required|string|email|max:255|unique:users,email,'.$id,
			'mobilenumber' => 'required|string|max:255|unique:users,mobilenumber,'.$id,
		
		  ],[],[

		  ]);
			$data=request()->except(['_token']);	
			if($request->is_mobile_verified=="on")
			{
				$data['is_mobile_verified']=1;
			}
			else{
				$data['is_mobile_verified']=0;
			}
			if($request->is_active=="on")
			{
				$data['is_active']=1;
			}
			else{
				$data['is_active']=0;
			}
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
			
			
			$user=User::where('id',$id)->update($data);
			
			if($user)
			{
				return redirect('/admin/user_list/')->with('success',"Profile updated successfully");
			}
			else
			{
				return redirect('/admin/user_list/')->with('error',"Error occuered while updating profile");
			}
		   
		  
		}
		
    }
	public function user_detail($id)
    {
       
        $user = User::where('id',$id)->first();  
        if(!empty($user)){
            return view("admin.user.user_detail",compact('user'));
        }else{
            return back()->with('No record found');
        }
    }
	
	public function fetch($id)
    {
       
        $user = User::where('id',$id)->first();  
        if(!empty($user)){
            return view("admin.user.edit",compact('user'));
        }else{
            return back()->with('No record found');
        }
    }
	
    public function delete(Request $request,$id)
    {
        if (User::where('id',$id)->exists()) {		  
		User::where('id',$id)->delete();
		return response()->json(['status' => 'success']);		 
		}
		else {
		  return response()->json(['status' => 'failure']);
		}
    }

 public function savePropertyOwnerBankDetails(Request $request,$id)
    {
        if($request->isMethod('post'))
		{			
			$propertyOwner=array();
			$holderName = ($request->account_holder_name)?$request->account_holder_name:Null;
			$phoneNumber = ($request->mobile_number)?$request->mobile_number:Null;
			
			//$propertyOwner   =   new PropertyOwnerBankDetails();                   
			$propertyOwner['name']           =   $holderName;
			$propertyOwner['mobile_number']   =  $phoneNumber;
			$propertyOwner['payment_type']    =  ($request->select_payment)?$request->select_payment:1 ;
			$propertyOwner['approved']       = ($request->approved)?$request->approved:0;
			
			if (!empty($request->authority_file)) {

				$authorityFile = $request->account_holder_name . '_' . time() . '.' . request()->authority_file->getClientOriginalExtension();
				$path = 'assets/img/ownerAuthorityFile';
				request()->authority_file->move(public_path($path), $authorityFile);
				$authorityFileImage =  'public/'.$path . '/' . $authorityFile;

			}else{

				$authorityFileImage   = Null;

			}
			if($request->select_payment == 1){                    
				
				$propertyOwner['account_number']  =   ($request->account_number)?$request->account_number:Null;
				$propertyOwner['ifsc']            =   ($request->ifsc)?$request->ifsc:Null;
				$propertyOwner['bank_name']       =   ($request->bank_name)?$request->bank_name:Null;
				$propertyOwner['upi_id']          =    Null;
				
				
			}elseif($request->select_payment == 2){

				$propertyOwner['upi_id']          =   ($request->upi_id_owner)?$request->upi_id_owner:Null;
				$propertyOwner['account_number']  =   Null;
				$propertyOwner['ifsc']            =   Null;
				$propertyOwner['bank_name']       =   Null;

			}
			
			if($authorityFileImage!=Null)
			{		
				$propertyOwner['authority_file']  =   $authorityFileImage;
			}					
			$owner_pay=PropertyOwnerBankDetails::where('id',$id)->first();
			if($owner_pay)
			{
				
				if($authorityFileImage!=Null || $request->approved!=$owner_pay->approved || $request->payment_type!=$owner_pay->select_payment || $request->account_number!=$owner_pay->account_number || $request->ifsc!=$owner_pay->ifsc || $request->bank_name!=$owner_pay->bank_name|| $request->mobile_number!=$owner_pay->mobile_number || $request->account_holder_name!=$owner_pay->name || $request->upi_id_owner!=$owner_pay->upi_id )
				{
					
					$owner=PropertyOwnerBankDetails::where('id',$id)->update($propertyOwner);
				}
				else
				{
						Session::flash('message', 'Nothing to update!'); 
						Session::flash('alert-class', 'alert-success');
						$flag=true;
						$owner=false;
				}
			}
			else
			{			
		
				$owner=PropertyOwnerBankDetails::save($propertyOwner);
			}
			if($owner)
			{
				Session::flash('message', 'Detail succussfully submitted for approval!'); 
				Session::flash('alert-class', 'alert-success'); 
			}
			else
			{
				if(!$flag)
				{
					Session::flash('message', 'Something went wrong!'); 
					Session::flash('alert-class', 'alert-danger'); 
				}
			}
			return redirect('/admin/owner_payment_detail_approval');		
		}
       else
		{
				$owner_pay=PropertyOwnerBankDetails::where('id',$id)->with('owner')->first();
				return view("admin.user.payment_detail",compact('owner_pay'));			
		}
		
    }

	function delete_bank_details(Request $request,$id)
    {
        if (PropertyOwnerBankDetails::where('id',$id)->exists()) {		  
		PropertyOwnerBankDetails::where('id',$id)->delete();
		return response()->json(['status' => 'success']);		 
		}
		else {
		  return response()->json(['status' => 'failure']);
		}
    }
}
