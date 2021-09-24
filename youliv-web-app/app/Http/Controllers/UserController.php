<?php

namespace App\Http\Controllers;

use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use DataTables;
use Validator;
use Exception;
use Session;
use App\User;
use App\Favorite;
use App\Property;
use Illuminate\Support\Facades\Hash;
Use File;
use Illuminate\Support\Str;
use URL;
class UserController extends Controller
{

    //
    public function __construct()
    {
    }

   public function add_favorite(Request $request)
    {
		$url=URL::previous();
		if(!isset($request->id) || $request->id!="")
		{
			$id=$request->id;
			
			$property=Property::where('id',$id)->first();
			$data['property_id']=$id;
			
			if(Auth::user())
			{
				$data['user_id']=Auth::user()->id;
				$sh_create=Favorite::create($data);
				//$request->session()->flash('success', 'Property successfully added to your favorite list!');				
				return response()->json(['code'=> 202,'url'=> $url]);
			}			
			else
			{
				 $request->session()->flash('success', 'You have to login first to add property into favorite list.');
				 $url=URL::previous();
				 session(['pro_id' => $id,'url'=>$url]);
				 return response()->json(['code'=> 200]);
			}
		}
		else
		{
			$request->session()->flash('error', 'something went wrong');
			return response()->json(['code'=> 200]);
			//return redirect('login')->with('success', "something went wrong");
		}
    }

	public function delete_fav(Request $request)
    {
		if(!isset($request->id) || $request->id!="")
		{
			
			  if (Favorite::where([['id',$request->id],['user_id',Auth::user()->id]])->exists()) {	
					Favorite::where([['id',$request->id],['user_id',Auth::user()->id]])->delete();	
					$fav_list=Favorite::where([['user_id',Auth::user()->id]])->with('property_details')->with('property_address')->with(['property_images'=>function($query) {
					return $query->limit(1);}])->with('property')->get();					
					return response()->json(['success' => 'Favorite property removed successfully','code' =>200,'list'=>$fav_list]);
				}
				else {
					$request->session()->flash('error', 'something went wrong');
					 return response()->json(['error' => 'Something went wrong','success' =>201]);
				}
		}
		else
		{
			$request->session()->flash('error', 'something went wrong');
			return response()->json(['code'=> 201]);
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



}
