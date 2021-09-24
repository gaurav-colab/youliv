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


class OwnerController extends Controller
{

    //
    public function __construct()
    {
    }

	public function index()
	{
	   //Owner::where('owner_number', $request->owner_number)->get();
	   $owner_detail=Owner::get();
	   return view('admin.owner.index',compact('owner_detail'));
	}
	public function create()
	{
	   return view('admin.owner.add');
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
			'owner_name' => 'required',
			'owner_number' => 'required|unique:owners',  
		  ]);

		if ($validator->fails()) {
		return back()->withErrors($validator)->withInput();
		}else
		{			  
			
			// OwnerImage Identity Front Side
			if (!empty($request->property_owner_id_front)) {
				$idFrontSide = $request->owner_name . '_' . time() . '.' . request()->property_owner_id_front->getClientOriginalExtension();
				$path = 'assets/img/ownerIdFrontSide';
				request()->property_owner_id_front->move(public_path($path), $idFrontSide);
				$idFrontSideImage =  $path . '/' . $idFrontSide;
			}else{
				$idFrontSideImage   = Null;
			}

			// OwnerImage Identity Back Side

			if (!empty($request->property_owner_id_back)) {
				$idBackSide = $request->owner_name . '_' . time() . '.' . request()->property_owner_id_back->getClientOriginalExtension();
				$path = 'assets/img/ownerIdBackSide';
				request()->property_owner_id_back->move(public_path($path), $idBackSide);
				$idBackSideImage =  $path . '/' . $idBackSide;
			}else{
				$idBackSideImage    =  Null ;
			}


			// Digital Signature Upload
/*
			if (!empty($request->digital_signature)) {
				$digital_signature = $request->owner_name . '_' . time() . '.' . request()->digital_signature->getClientOriginalExtension();
				$path = 'assets/img/digital_signature';
				request()->digital_signature->move(public_path($path), $digital_signature);
				$OwnerDigitalSignature =  $path . '/' . $digital_signature;
			}else{
				$OwnerDigitalSignature = Null;
			}
*/
			$ownerData	=	Owner::where('owner_number', $request->owner_number)->first();

			if(!empty($ownerData)){
				$ownData	=	Owner::where('owner_number', $request->owner_number)
							->update([
								'owner_name'   		=> $request->owner_name,
								'alernate_number' 	=> ($request->alernate_number)?$request->alernate_number:NULL,
								'owner_email'		=> ($request->owner_email)?$request->owner_email:NULL,
								'password'          => Hash::make($request->owner_number),								
								'property_owner_id_drop'	=> $request->property_owner_id_drop,
								'property_owner_id_front'	=> $idFrontSideImage,
								'property_owner_id_back'	=> $idBackSideImage,
								'property_gst'	        	=> ($request->property_gst)?$request->property_gst:NULL,								
							]);

				$owner_id	=	$ownerData->id;

			}else{

					$owner = new Owner();
					$owner->owner_name   = $request->owner_name;
					$owner->owner_number = $request->owner_number;
					$owner->alernate_number = ($request->alernate_number)?$request->alernate_number:NULL;
					$owner->owner_email             = ($request->owner_email)?$request->owner_email:NULL;
					$owner->password                = Hash::make($request->owner_number);					
					$owner->property_owner_id_drop	= $request->property_owner_id_drop;
					$owner->property_owner_id_front	= $idFrontSideImage;
					$owner->property_owner_id_back	= $idBackSideImage;
					$owner->property_gst	        = ($request->property_gst)?$request->property_gst:NULL;				
					$owner->save();

					$owner_id = $owner->id;

			}
		   if($owner_id)
		  {
			Session::flash('success','Property Owner detail successfully added.');			
		  }
		  else
		  {		
			Session::flash('error','Error occured while updateing data');	  
		  }
		  
		 return redirect('admin/add_propery_owner');
		}
    }
   public function update(Request $request,$id)
    {
        // OwnerImage
		$validator = Validator::make($request->all(), [
			'owner_name' => 'required',
			'owner_number' => 'required|unique:owners,owner_number,'.$id,   			
		  ]);

		if ($validator->fails()) {
		return back()->withErrors($validator)->withInput();
		}else
		{			  
			

			// OwnerImage Identity Front Side
			if (!empty($request->property_owner_id_front)) {
				$idFrontSide = $request->owner_name . '_' . time() . '.' . request()->property_owner_id_front->getClientOriginalExtension();
				$path = 'assets/img/ownerIdFrontSide';
				request()->property_owner_id_front->move(public_path($path), $idFrontSide);
				$idFrontSideImage =  $path . '/' . $idFrontSide;
			}else{
				$idFrontSideImage   = Null;
			}

			// OwnerImage Identity Back Side

			if (!empty($request->property_owner_id_back)) {
				$idBackSide = $request->owner_name . '_' . time() . '.' . request()->property_owner_id_back->getClientOriginalExtension();
				$path = 'assets/img/ownerIdBackSide';
				request()->property_owner_id_back->move(public_path($path), $idBackSide);
				$idBackSideImage =  $path . '/' . $idBackSide;
			}else{
				$idBackSideImage    =  Null ;
			}
			
			$ownerData	=	Owner::where('id', $request->id)->first();
			
				$data['owner_name']=$request->owner_name;
				$data['alernate_number']=($request->alernate_number)?$request->alernate_number:NULL;
				$data['owner_email']=($request->owner_email)?$request->owner_email:NULL;	
				$data['property_owner_id_drop']=$request->property_owner_id_drop;
				if($idFrontSideImage!=Null)
				{
					$data['property_owner_id_front']= $idFrontSideImage;
				}
				if($idBackSideImage!=Null)
				{
					$data['property_owner_id_back']=$idBackSideImage;
				}
				$data['property_gst']=($request->property_gst)?$request->property_gst:NULL;
				if(!empty($ownerData)){
					$ownData	=	Owner::where('id', $request->id)
								->update($data);

					$owner_id	=	$ownerData->id;

				}else{
						Session::flash('error','Error occured while updating data');	  
				}
			

			}
		   if($owner_id)
		  {
			Session::flash('success','Property Owner detail successfully updated.');			
		  }
		  else
		  {		
			Session::flash('error','Error occured while updating data');	  
		  }
		  
		 return redirect('admin/property_owner_list');
		
    }
	public function owner_detail($id)
    {
       
        $owner_detail = Owner::where('id',$id)->first();  
        if(!empty($owner_detail)){
            return view("admin.owner.owner_detail",compact('owner_detail'));
        }else{
            return back()->with('No record found');
        }
    }
	
	public function fetch($id)
    {
       
        $owner_detail = Owner::where('id',$id)->first();  
        if(!empty($owner_detail)){
            return view("admin.owner.edit",compact('owner_detail'));
        }else{
            return back()->with('No record found');
        }
    }
	
    function upload(Request $request)
    {

        $images = $request->file('file');

        foreach ($images as $image) {

            $getImageName = time() . '.' . $image->getClientOriginalExtension();
            $path = 'assets/img/property_images';
            $image->move(public_path($path), $getImageName);
            //$imageName =  url($path . '/' . $getImageName);
            $imageName =  'public/'.$path . '/' . $getImageName;
            return response()->json(['success' => $imageName]);
        }
    }
/*
    function fetch()
    {
        $images = \File::allFiles(public_path('images'));
        $output = '<div class="row">';
        foreach ($images as $image) {
            $output .= '
            <div class="col-md-2" style="margin-bottom:16px;" align="center">
                <img src="' . asset('images/' . $image->getFilename()) . '" class="img-thumbnail" width="175" height="175" style="height:175px;" />
                <button type="button" class="btn btn-link remove_image" id="' . $image->getFilename() . '">Remove</button>
            </div>
      ';
        }
        $output .= '</div>';
        echo $output;
    }*/

    function delete(Request $request,$id)
    {
        if (Owner::where('id',$id)->exists()) {		  
		Owner::where('id',$id)->delete();
		return response()->json(['status' => 'success']);		 
		}
		else {
		  return response()->json(['status' => 'failure']);
		}
    }



}
