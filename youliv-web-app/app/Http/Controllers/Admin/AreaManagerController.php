<?php

namespace App\Http\Controllers\admin;

use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
use DataTables;
use Validator;
use Exception;
use Session;
use Illuminate\Support\Facades\Hash;


class AreaManagerController extends Controller
{

    //
    public function __construct()
    {
    }

	public function index()
	{
	   //Owner::where('owner_number', $request->owner_number)->get();
	   $owner_detail=AreaManager::get();
	   return view('admin.areamanager.index',compact('owner_detail'));
	}
	public function create()
	{
	   return view('admin.areamanager.add');
	}

    /*
    *
    *   save Property owner Details
    *
    */

    public function store(Request $request)
    {
        // OwnerImage
		$validator = Validator::make($request->all(), [
			'name' => 'required|max:50',
			'email' => 'required|unique:area_managers|email|max:255',   
			'password' => 'required|min:6|max:20',
			'phone' => 'required|numeric|digits_between:1,15',
			'emp_code' => 'required|max:50',
			'doj' => 'required',
			'pan_front' => 'required',
			'pan_back' => 'required',
			'adhar_front' => 'required',
			'adhar_back' => 'required',
			'p_address' => 'required',
			'c_address' => 'required',
		  ]);

		if ($validator->fails()) {
		return back()->withErrors($validator)->withInput();
		}else
		{	
	
		
			if (!empty($request->pan_front)) {
				$idFrontSide = $request->name . '_1_' . time() . '.' . request()->pan_front->getClientOriginalExtension();
				$path = 'assets/img/managerFrontSide';
				request()->pan_front->move(public_path($path), $idFrontSide);
				$idFrontSideImagePan =  $path . '/' . $idFrontSide;
			}else{
				$idFrontSideImagePan   = Null;
			}

			// OwnerImage Identity Back Side

			if (!empty($request->pan_back)) {
				$idBackSide = $request->name . '_2_' . time() . '.' . request()->pan_back->getClientOriginalExtension();
				$path = 'assets/img/managerFrontSide';
				request()->pan_back->move(public_path($path), $idBackSide);
				$idBackSideImagePan =  $path . '/' . $idBackSide;
			}else{
				$idBackSideImagePan    =  Null ;
			}
			
			
			if (!empty($request->adhar_front)) {
				$idFrontSide = $request->name . '_3_' . time() . '.' . request()->adhar_front->getClientOriginalExtension();
				$path = 'assets/img/managerFrontSide';
				request()->adhar_front->move(public_path($path), $idFrontSide);
				$idFrontSideImageAdhar =  $path . '/' . $idFrontSide;
			}else{
				$idFrontSideImageAdhar   = Null;
			}

			// OwnerImage Identity Back Side

			if (!empty($request->adhar_back)) {
				$idBackSide = $request->name . '_4_' . time() . '.' . request()->adhar_back->getClientOriginalExtension();
				$path = 'assets/img/managerFrontSide';
				request()->adhar_back->move(public_path($path), $idBackSide);
				$idBackSideImageAdhar =  $path . '/' . $idBackSide;
			}else{
				$idBackSideImageAdhar    =  Null ;
			}

			$areamanager = new AreaManager();
			$areamanager->name  = $request->name;
			$areamanager->phone = $request->phone;					
			$areamanager->email = $request->email;
			$areamanager->p_address = $request->p_address;					
			$areamanager->c_address = $request->c_address;
			$areamanager->password =   Hash::make($request->password);	
			$areamanager->emp_code = $request->emp_code;
			$areamanager->doj = $request->doj;
			$areamanager->pan_front = $idBackSideImagePan;
			$areamanager->pan_back = $idBackSideImagePan;
			$areamanager->adhar_front = $idFrontSideImageAdhar;
			$areamanager->adhar_back = $idBackSideImageAdhar;
			
			$areamanager->save();

			$areamanager_id = $areamanager->id;

			
		   if($areamanager_id)
		  {
			Session::flash('success','Area Manager detail successfully added.');			
		  }
		  else
		  {		
			Session::flash('error','Error occured while updateing data');	  
		  }
		  
		 return redirect('admin/area_manager_list');
		}
    }
   public function update(Request $request,$id)
    {
        // OwnerImage
		if($request->password!="")
		{
			$validator = Validator::make($request->all(), [
				'name' => 'required|max:50',
				'email' => 'required|email|max:255|unique:area_managers,email,'.$id,   
				'password' => 'required|min:6|max:20',
				'phone' => 'required|numeric|digits_between:1,15',
				'emp_code' => 'required|max:50',
				'doj' => 'required',	
				'p_address' => 'required',
				'c_address' => 'required',				
			  ]);
		}
		else
		{
			$validator = Validator::make($request->all(), [
				'name' => 'required|max:50',
				'email' => 'required|email|max:255|unique:area_managers,email,'.$id,
				'phone' => 'required|numeric|digits_between:1,15',
				'emp_code' => 'required|max:50',
				'doj' => 'required',
				'p_address' => 'required',
				'c_address' => 'required',				
			  ]);
		}

		if ($validator->fails()) {
		return back()->withErrors($validator)->withInput();
		}else
		{
			  
			if (!empty($request->pan_front)) {
				$idFrontSide = $request->name . '_1_' . time() . '.' . request()->pan_front->getClientOriginalExtension();
				$path = 'assets/img/managerFrontSide';
				request()->pan_front->move(public_path($path), $idFrontSide);
				$idFrontSideImagePan =  $path . '/' . $idFrontSide;
			}else{
				$idFrontSideImagePan   = Null;
			}

			// OwnerImage Identity Back Side

			if (!empty($request->pan_back)) {
				$idBackSide = $request->name . '_2_' . time() . '.' . request()->pan_back->getClientOriginalExtension();
				$path = 'assets/img/managerFrontSide';
				request()->pan_back->move(public_path($path), $idBackSide);
				$idBackSideImagePan =  $path . '/' . $idBackSide;
			}else{
				$idBackSideImagePan    =  Null ;
			}
			
			
			if (!empty($request->adhar_front)) {
				$idFrontSide = $request->name . '_3_' . time() . '.' . request()->adhar_front->getClientOriginalExtension();
				$path = 'assets/img/managerFrontSide';
				request()->adhar_front->move(public_path($path), $idFrontSide);
				$idFrontSideImageAdhar =  $path . '/' . $idFrontSide;
			}else{
				$idFrontSideImageAdhar   = Null;
			}

			// OwnerImage Identity Back Side

			if (!empty($request->adhar_back)) {
				$idBackSide = $request->name . '_4_' . time() . '.' . request()->adhar_back->getClientOriginalExtension();
				$path = 'assets/img/managerFrontSide';
				request()->adhar_back->move(public_path($path), $idBackSide);
				$idBackSideImageAdhar =  $path . '/' . $idBackSide;
			}else{
				$idBackSideImageAdhar    =  Null ;
			}
			
			$ownerData	=	AreaManager::where('id', $request->id)->first();
			
			$data['name']  = $request->name;
			$data['phone'] = $request->phone;					
			$data['email'] = $request->email;
			$data['p_address'] = $request->p_address;
			$data['c_address'] = $request->c_address;
			if($request->password!="")
			{
				$data['password'] =   Hash::make($request->password);
			}			
			$data['emp_code'] = $request->emp_code;
			$data['doj'] = $request->doj;
			
			if($idBackSideImagePan!=Null)
			{
				$data['pan_front'] = $idFrontSideImagePan;
			}
			if($idBackSideImagePan!=Null)
			{
				$data['pan_back'] = $idBackSideImagePan;
			}
			if($idBackSideImagePan!=Null)
			{
				$data['adhar_front'] = $idFrontSideImageAdhar;
			}
			if($idBackSideImagePan!=Null)
			{
				$data['adhar_back'] = $idBackSideImageAdhar;
			}
			if(!empty($ownerData)){
				$ownData	=	AreaManager::where('id', $request->id)
							->update($data);

				$owner_id	=	$ownerData->id;

			}else{
					Session::flash('error','Error occured while updating data');	  
			}

			}
		   if($owner_id)
		  {
			Session::flash('success','Area Manager detail successfully updated.');			
		  }
		  else
		  {		
			Session::flash('error','Error occured while updating data');	  
		  }
		  
		 return redirect('admin/area_manager_list');
		
    }
	public function area_manager_detail($id)
    {
       
        $owner_detail = AreaManager::where('id',$id)->first(); 
        if(!empty($owner_detail)){
            //return view("admin.owner.owner_detail",compact('owner_detail'));
        }else{
           // return back()->with('No record found');
        }
		 return view('admin.areamanager.areamanger_detail',compact('owner_detail'));
    }
	
	public function fetch($id)
    {
       
        $areamanager_detail = AreaManager::where('id',$id)->first();  
        if(!empty($areamanager_detail)){
            return view("admin.areamanager.edit",compact('areamanager_detail'));
        }else{
            return back()->with('No record found');
        }
    }
	/*
    function delete(Request $request,$id)
    {
        if (AreaManager::where('id',$id)->exists()) {		  
		AreaManager::where('id',$id)->delete();
		return response()->json(['status' => 'success']);		 
		}
		else {
		  return response()->json(['status' => 'failure']);
		}
    }
	*/
	function delete(Request $request,$id)
    {
		$areamanager_detail = AreaManager::where('id',$id)->first();
		$area_managers = AreaManager::get(); 
		if($request->isMethod('post'))
		{	
			if (AreaManager::where('id',$id)->exists()) {		  
				Property::where('area_manager_id',$request->areamanager_id)->update(array('area_manager_id'=>$request->area_manager_id));
				AreaManager::where('id',$request->areamanager_id)->delete();
				Session::flash('success','Area Manager assign successfully.');		 
			}
			else {
			 Session::flash('error','Error occured while updating data');	
			}
			
			return redirect('admin/area_manager_list');
		}		
		return view("admin.areamanager.delete",compact('areamanager_detail','area_managers'));
		
    }

}
