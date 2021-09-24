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
use App\PropertyInventoryRequest;
use App\PropertyInventoryDescription;
use App\PropertyDescription;
use App\PropertyAdditionalInformation;
use App\PropertyImages;
use App\PropertyAmenities;
use App\PropertyAddress;
use App\PropertyDigitalSignature;
use App\PropertyNeighbourhood;
use App\PropertyRequestDescription;
use App\PropertyRequestDetail;
use App\PropertyRequestAmenities;
use DataTables;
use Illuminate\Support\Facades\Hash;
use File;
use Image;
use Sheets;

class PropertyController extends Controller
{

    //
    public function __construct()
    {
    }

    public function add_property()
    {

        $state = State::get();
        $sector = Sector::get();
        $city = City::get();
		$owners_list=array();
        $amenity = Amenties::orderBy('id', 'asc')->get();
		$owners_details = Owner::select('id','owner_name','owner_number')->get();
		foreach($owners_details as $key=>$value)
		{
			$owners_list[]=array('id'=>$value->id,'name'=>$value->owner_number.'('.$value->owner_name.')');
		}
		//dd($owners_list);
        $area_managers = AreaManager::get()->toArray();

        return view("admin.property.add_property", compact('sector','state','city','area_managers','amenity','owners_list'));
    }

    public function getCityInfo($id)
    {
        $cities = city::where('state_id', '=', $id)->get();
        $cities =  json_decode(json_encode($cities), true);
        return response()->json($cities);
    }
    public function getSectorInfo($id)
    {
        $cities = Sector::where('city_id', '=', $id)->get();
        $cities =  json_decode(json_encode($cities), true);
        return response()->json($cities);
    }

    private function validator(Request $request)
    {
        $rules = [
            'area_manager_id' => 'required',
            'owner_name' => 'required',
            'owner_number' => 'required',
            'property_owned' => 'required',
            'lease_unit'=>  'required_if:property_owned,2',
            'lease_duration'=>  'required_if:property_owned,2',
            'lease_expiry'=>  'required_if:property_owned,2',
            'lease_deed'=>  'required_if:property_owned,2',
            'id_proof_address'=>  'required_if:property_owned,1',
            'property_diff_address' => 'required_if:id_proof_address,2',
            'property_address_img' => 'required_if:id_proof_address,2',
            'property_type' => 'required',
            'total_room_for_rent'=> 'required_if:property_type,1',
            'total_bed_for_rent'=> 'required_if:property_type,2',


           // 'deals' => 'required',
            'address_house' => 'required',
            'address_building' => 'required',
            'address_street' => 'required',
            'address_state' => 'required',
            'address_city' => 'required',
            'address_sector' => 'required',
            'zipcode' => 'required',
            'property_lat' => 'required',
            'furnishing' => 'required',
            'owner_free' => 'required',
            'property_available' => 'required',
            'digital_signature' => 'required',
            'property_owner_image' => 'required',
            'property_owner_id_drop' => 'required',
            'property_owner_id_front' => 'required',
            'property_owner_id_back' => 'required',
            'food_inclusive' => 'required',
            'electricity_inclusive' => 'required',
        ];

        //custom validation error messages.
        $messages = [
            'lease_unit.required_if' => 'The lease unit field is required',
            'lease_duration.required_if' => 'The lease duration field is required',
            'lease_expiry.required_if' => 'The lease expiry field is required',
            'lease_deed.required_if' => 'The lease deed document field is required',
            'id_proof_address.required_if' => 'Identity proof with same address field is required',
            'property_diff_address.required_if' => 'Identity proof with different address field is required',
            'property_address_img.required_if' => 'Identity proof with different address document field is required',
            'total_room_for_rent.required_if' => 'Number of Rooms for Rent field is required',
            'total_bed_for_rent.required_if' => 'Number of Beds for Rent field is required',
        ];

        $request->validate($rules,$messages);
    }

    /*
    *
    *   save Property owner Details
    *
    */

    public function saveOwnerDetails(Request $request)
    {
        // OwnerImage



        $ownerData	=	PropertyOwner::where([['property_id', $request->propertyId]])->first();

		$owner_id="";
        if(!empty($ownerData)){
			$ownData	=	PropertyOwner::where([['id', $ownerData->id]])
					    ->update([
                            'owner_id'   		=> $request->ownerId,

                        ]);

						$owner_id	=	$ownerData->id;

		}

        return response()->json(['owner_id'   => $owner_id]);
    }

     /*
    *
    *   save Property area manager Details
    *
    */

    public function savePropertyManagerDetails(Request $request)
    {


		//property_owners_id

        $authId =   Auth::guard('admin')->user()->id;

        $data = '1234567890';
		$propertyCode="";
		/*
        if($request->address_city){
            $cities = city::where('id', '=', $request->address_city)->first();
            $cityName   =   $cities->name;
            $propertyCode   =  substr($cityName, 0, 4).substr(str_shuffle($data), 0, 5);

        }else{
            $propertyCode   =   'YOULIV' . substr(str_shuffle($data), 0, 5);
        }
		*/

        $property = new Property();

        if(!empty($request->propertyId)){
            //$propertyData	=	property::where('id', $request->propertyId)->first();

			$propertyData	=	property::where('id', $request->propertyId)
                                ->update([
                                    'added_by'   		=> $authId,
                                    'added_by_type' 	=> 1,
                                    'area_manager_id'	=> ($request->area_manager_id)?$request->area_manager_id:Null,

                                    'deals'		        => ($request->deals)?$request->deals:25,
                                ]);

            if($propertyData){
                $propertyId	=	$request->propertyId;
            }

        }else{
            $property->added_by = $authId;
            $property->added_by_type = "1";
            $property->area_manager_id = $request->area_manager_id;
            $property->property_code = $propertyCode;
            $property->deals = ($request->deals)?$request->deals:25;
            $property->save();
            $propertyId = $property->id;
        }
		$detail=PropertyOwner::where([['owner_id', $request->ownerId],['property_id', $request->propertyId]])->first();
		if($detail)
		{


			$propertyOwner	=	PropertyOwner::where('id', $detail->id)->update([
				'owner_id'    => $request->ownerId,
				'property_id' => $propertyId

			]);

			$propertyOwnerId	=	$propertyId;
		}
		else{
			$propertyOwner = new PropertyOwner();

			$propertyOwner->owner_id    = $request->ownerId;
			$propertyOwner->property_id = $propertyId;
			$propertyOwner->save();

			$propertyOwnerId = $propertyOwner->id;
		}
        if(!empty($propertyId)){

            return response()->json(['propertyId'   => $propertyId]);
        }

    }


     /*
    *
    *   save Property owner lease Details
    *
    */
	public function savePropertyDigitalSignatureDetails(Request $request)
		{
			// digital_signature



			$detail=PropertyDigitalSignature::where('property_id',$request->propertyId)->first();
			if (!empty($request->digital_signature)) {
					$digital_signature = 'sign'. '_' . time() . '.' . request()->digital_signature->getClientOriginalExtension();
					$path = 'assets/img/digital_signature';
					request()->digital_signature->move(public_path($path), $digital_signature);
					$OwnerDigitalSignature =  'public/'.$path . '/' . $digital_signature;
			}
			if($detail)
			{
				$propertyDigitalSignature = new PropertyDigitalSignature();



					if (File::exists('public/assets/img/digital_signature/'.$detail->digital_signature)) {
						unlink('public/assets/img/digital_signature/'.$detail->digital_signature);
					}

					$propertyDigitalSignature	=	PropertyDigitalSignature::where('id', $detail->id)->update([
					'digital_signature'    => $OwnerDigitalSignature,
					'property_id' => $request->propertyId,
					]);

				$propertyDetailId   =   $detail->id;
			}
			else
			{
				$propertyDigitalSignature = new PropertyDigitalSignature();
				if (!empty($request->digital_signature)) {
					$propertyDigitalSignature->digital_signature 	= $OwnerDigitalSignature;
				}
				$propertyDigitalSignature->property_id 	= $request->propertyId;
				$propertyDigitalSignature->save();

				$propertyDetailId   =   $propertyDigitalSignature->id;
			}

			if(!empty($propertyDetailId)){

				return response()->json(['propertyId'   => $propertyDetailId]);
			}

		}


    public function savePropertyOwnerDetails(Request $request)
    {
        // identity lease_deed image

        if (!empty($request->lease_deed)) {
            $lease_deed = $request->owner_name . '_' . time() . '.' . request()->lease_deed->getClientOriginalExtension();
            $path = 'assets/img/lease_deed';
            request()->lease_deed->move(public_path($path), $lease_deed);
            $OwnerLeaseDeedImage =  'public/'.$path . '/' . $lease_deed;
        }else{
            $OwnerLeaseDeedImage = Null;
        }

        if (!empty($request->property_address_img)) {
            $property_address_img = $request->owner_name . '_' . time() . '.' . request()->property_address_img->getClientOriginalExtension();
            $path = 'assets/img/lease_deed';
            request()->property_address_img->move(public_path($path), $property_address_img);
            $OwnerDiffrentAddrImage =  'public/'.$path . '/' . $property_address_img;
        }else{
            $OwnerDiffrentAddrImage = Null;
        }


        if (!empty($request->ownerId) && !empty($request->propertyId)) {

			$detail=PropertyOwner::where([['owner_id', $request->ownerId],['property_id', $request->propertyId]])->first();

			if($detail)
			{

				$data['owner_id'] = $request->ownerId;
				$data['property_id'] = $request->propertyId;
				$data['property_owned'] = ($request->property_owned)?$request->property_owned:1;

				if($OwnerLeaseDeedImage!=Null)
				{
					$data['lease_deed'] = $OwnerLeaseDeedImage;
				}
				//dd($request);
				if($request->property_owned==2)
				{
					$data['id_proof_is_same_address'] = 0;
					 $data['property_diff_address'] = Null;
					 $data['lease_unit'] = ($request->lease_unit)?$request->lease_unit:Null;
					$data['lease_duration'] = ($request->lease_duration)?$request->lease_duration:Null;
					$data['lease_expiry'] =  ($request->lease_expiry)?$request->lease_expiry:Null;
				}
				else
				{
					$data['lease_unit'] = Null;
					$data['lease_duration'] = Null;
					$data['lease_expiry'] =  Null;
					$data['id_proof_is_same_address'] = ($request->id_proof_address)? $request->id_proof_address:2;
					if($request->id_proof_address==2)
					{
						$data['property_diff_address'] = ($request->property_diff_address)?$request->property_diff_address:Null;
					}
					else{
						$data['property_diff_address']=0;
						$data['property_address_img'] =Null;
					}

				}
				//$data['property_diff_address'] = ($request->property_diff_address)?$request->property_diff_address:Null;
				if($OwnerDiffrentAddrImage!=Null)
				{
					$data['property_address_img'] = $OwnerDiffrentAddrImage;
				}
				$propertyOwner	=	PropertyOwner::where('id', $detail->id)->update($data);

				$propertyOwnerId	=	$detail->id;
			}
			else{
				$propertyOwner = new PropertyOwner();

				$propertyOwner->owner_id    = $request->ownerId;
				$propertyOwner->property_id = $request->propertyId;
				if($request->property_owned==2)
				{
					$propertyOwner->id_proof_is_same_address = 0;
					$propertyOwner->property_diff_address = Null;
					$propertyOwner->lease_unit = ($request->lease_unit)?$request->lease_unit:Null;
					$propertyOwner->lease_duration = ($request->lease_duration)?$request->lease_duration:Null;
					$propertyOwner->lease_expiry =  ($request->lease_expiry)?$request->lease_expiry:Null;
					$propertyOwner->lease_deed= $OwnerLeaseDeedImage;
				}
				else
				{
					$propertyOwner->lease_unit = Null;
					$propertyOwner->lease_duration = Null;
					$propertyOwner->lease_expiry =  Null;
					$propertyOwner->lease_deed= Null;
					$propertyOwner->id_proof_is_same_address = ($request->id_proof_address)? $request->id_proof_address:2;
					if($request->id_proof_address==2)
					{
						$propertyOwner->property_diff_address= ($request->property_diff_address)?$request->property_diff_address:Null;
						$propertyOwner->property_address_img = $OwnerDiffrentAddrImage;
					}
					else{
						$propertyOwner->property_diff_address=0;
						$propertyOwner->property_address_img =Null;
					}

				}

				$propertyOwner->save();

				$propertyOwnerId = $propertyOwner->id;
			}


            if(!empty($propertyOwnerId)){

                return response()->json(['propertyId'   => $propertyOwnerId]);
            }

        }


    }

     /*
    *
    *save Property General Details
    *
    */

    public function savePropertyGeneralDetails(Request $request)
    {
        if ($request->propertyId) {

            //update Property Details
			 $property_id=$request->propertyId;
			$detail=PropertyDetail::where('property_id',$request->propertyId)->first();
			if($detail)
			{
				PropertyDetail::where('property_id',$request->propertyId)->delete();
			}
            $propertyDetail = new PropertyDetail();

            $propertyDetail->property_id      =  $property_id;
            $propertyDetail->property_type    =  ($request->property_type)?$request->property_type:1 ;
			$propertyDetail->water_inclusive = $request->water_inclusive ;
			$propertyDetail->property_title = $request->property_title ;
			$propertyDetail->property_about = $request->property_about ;
			$propertyDetail->featured =  ($request->featured=="on")?1:0 ;
            $propertyDetail->property_available_men =  ($request->property_available_men=="on")?1:0 ;
			$propertyDetail->property_available_women = ($request->property_available_women =="on")?1:0 ;
			$propertyDetail->property_available_unisex = ($request->property_available_unisex=="on")?1:0 ;
			$propertyDetail->property_available_family = ($request->property_available_family =="on")?1:0 ;
            $propertyDetail->furnishing       =  ($request->furnishing)?$request->furnishing: 1 ;
            $propertyDetail->owner_free      =  ($request->owner_free)?$request->owner_free: 1 ;
            $propertyDetail->total_room_for_rent  = ($request->total_room_for_rent)?$request->total_room_for_rent: null ;
            $propertyDetail->total_bed_for_rent   = ($request->total_bed_for_rent)?$request->total_bed_for_rent: null ;
            $propertyDetail->food_inclusive       =  ($request->food_inclusive)?$request->food_inclusive: 1 ;
			$propertyDetail->food_exclusive       =  ($request->food_exclusive)?$request->food_exclusive: 2 ;
            $propertyDetail->electricity_inclusive  = ($request->electricity_inclusive)?$request->electricity_inclusive: 1 ;
            $propertyDetail->food_exclusive_rent  = ($request->food_exclusive_price)?$request->food_exclusive_price: null ;

            $propertyDetail->save();
            $propertyDetailId   =   $propertyDetail->id;

            // Update Property Description


            //$PropertyDescription->property_id = $request->propertyId;
			//dd($request);
            if(isset($request->room_type))
			{
				PropertyDescription::where('property_id',$property_id)->delete();
				$PropertyDescription = new PropertyDescription();

				if (in_array("single_sharing", $request->room_type)) {
					 $PropertyDescription = new PropertyDescription();
					//$detail=PropertyDescription::where([['property_id',$request->propertyId],['room_type',1]])->first();
					//if($detail)
					//{
					//	PropertyDescription::where('id',$detail->id)->delete();
					//}

					$PropertyDescription->property_id     = $property_id;
					$PropertyDescription->room_type     = 1;
					$PropertyDescription->quantity      = $request->single_sharing_quantity;
					$PropertyDescription->rent          = $request->single_sharing_rent;
					$PropertyDescription->security      = $request->single_sharing_security;
					$PropertyDescription->description   = $request->single_sharing_description;

					$Property_description_id = $PropertyDescription->save();
				}

				if (in_array("twin_sharing", $request->room_type)) {

				    $PropertyDescription = new PropertyDescription();
					//$detail=PropertyDescription::where([['property_id',$request->propertyId],['room_type',2]])->first();
					//if($detail)
					///{
						//PropertyDescription::where('id',$detail->id)->delete();
					//}
					$PropertyDescription->property_id     = $property_id;
					$PropertyDescription->room_type = 2;
					$PropertyDescription->quantity = $request->twin_sharing_quantity;
					$PropertyDescription->rent = $request->twin_sharing_rent;
					$PropertyDescription->security = $request->twin_sharing_security;
					$PropertyDescription->description = $request->twin_sharing_description;
					$Property_description_id = $PropertyDescription->save();
				}

				if (in_array("triple_sharing", $request->room_type)) {

				    $PropertyDescription = new PropertyDescription();
					//$detail=PropertyDescription::where([['property_id',$request->propertyId],['room_type',3]])->first();
					//if($detail)
					//{
					//	PropertyDescription::where('id',$detail->id)->delete();
					//}
					$PropertyDescription->property_id     = $property_id;
					$PropertyDescription->room_type = 3;
					$PropertyDescription->quantity = $request->triple_sharing_quantity;
					$PropertyDescription->rent = $request->triple_sharing_rent;
					$PropertyDescription->security = $request->triple_sharing_security;
					$PropertyDescription->description = $request->triple_sharing_description;

					$Property_description_id = $PropertyDescription->save();
				}

				if (in_array("other", $request->room_type)) {

				    $PropertyDescription = new PropertyDescription();
					//$detail=PropertyDescription::where([['property_id',$request->propertyId],['room_type',4]])->first();
					//if($detail)
					//{
					//	PropertyDescription::where('id',$detail->id)->delete();
					//}
					$PropertyDescription->property_id     = $property_id;
					$PropertyDescription->room_type = 4;
					$PropertyDescription->quantity = $request->other_room_quantity;
					$PropertyDescription->rent = $request->other_room_rent;
					$PropertyDescription->security = $request->other_room_security;
					$PropertyDescription->description = $request->other_room_description;

					$Property_description_id = $PropertyDescription->save();
				}
			}
			if(isset($request->flat_type))
			{
				PropertyDescription::where('property_id',$property_id)->delete();

				if (in_array("one_room", $request->flat_type)) {
					$PropertyDescription = new PropertyDescription();
					//$detail=PropertyDescription::where([['property_id',$request->propertyId],['room_type',5]])->first();
					//if($detail)
					//{
						//PropertyDescription::where('id',$detail->id)->delete();
					//}
					$PropertyDescription->property_id     = $property_id;
					$PropertyDescription->room_type = 9;
					$PropertyDescription->quantity = $request->one_room_quantity;
					$PropertyDescription->rent = $request->one_room_rent;
					$PropertyDescription->security = $request->one_room_security;
					$PropertyDescription->description = $request->one_room_description;

					$Property_description_id = $PropertyDescription->save();
				}
				if (in_array("two_room", $request->flat_type)) {
					$PropertyDescription = new PropertyDescription();
					//$detail=PropertyDescription::where([['property_id',$request->propertyId],['room_type',5]])->first();
					//if($detail)
					//{
						//PropertyDescription::where('id',$detail->id)->delete();
					//}
					$PropertyDescription->property_id     = $property_id;
					$PropertyDescription->room_type = 10;
					$PropertyDescription->quantity = $request->two_room_quantity;
					$PropertyDescription->rent = $request->two_room_rent;
					$PropertyDescription->security = $request->two_room_security;
					$PropertyDescription->description = $request->two_room_description;

					$Property_description_id = $PropertyDescription->save();
				}
				if (in_array("three_room", $request->flat_type)) {
					$PropertyDescription = new PropertyDescription();

					$PropertyDescription->property_id     = $property_id;
					$PropertyDescription->room_type = 13;
					$PropertyDescription->quantity = $request->three_room_quantity;
					$PropertyDescription->rent = $request->three_room_rent;
					$PropertyDescription->security = $request->three_room_security;
					$PropertyDescription->description = $request->three_room_description;

					$Property_description_id = $PropertyDescription->save();
				}

				if (in_array("one_rk", $request->flat_type)) {
					$PropertyDescription = new PropertyDescription();
					//$detail=PropertyDescription::where([['property_id',$request->propertyId],['room_type',5]])->first();
					//if($detail)
					//{
						//PropertyDescription::where('id',$detail->id)->delete();
					//}
					$PropertyDescription->property_id     = $property_id;
					$PropertyDescription->room_type = 5;
					$PropertyDescription->quantity = $request->one_rk_quantity;
					$PropertyDescription->rent = $request->one_rk_rent;
					$PropertyDescription->security = $request->one_rk_security;
					$PropertyDescription->description = $request->one_rk_description;

					$Property_description_id = $PropertyDescription->save();
				}


				if (in_array("one_bhk", $request->flat_type)) {
					$PropertyDescription = new PropertyDescription();
					//$detail=PropertyDescription::where([['property_id',$request->propertyId],['room_type',6]])->first();
					//if($detail)
					//{
					//	PropertyDescription::where('id',$detail->id)->delete();
					//}
					$PropertyDescription->property_id     = $property_id;
					$PropertyDescription->room_type = 6;
					$PropertyDescription->quantity = $request->one_bhk_quantity;
					$PropertyDescription->rent = $request->one_bhk_rent;
					$PropertyDescription->security = $request->one_bhk_security;
					$PropertyDescription->description = $request->one_bhk_description;

					$Property_description_id = $PropertyDescription->save();
				}

				if (in_array("two_bhk", $request->flat_type)) {
					$PropertyDescription = new PropertyDescription();
					//$detail=PropertyDescription::where([['property_id',$request->propertyId],['room_type',7]])->first();
					//if($detail)
					//{
						//PropertyDescription::where('id',$detail->id)->delete();
					//}
					$PropertyDescription->property_id     = $property_id;
					$PropertyDescription->room_type = 7;
					$PropertyDescription->quantity = $request->two_bhk_quantity;
					$PropertyDescription->rent = $request->two_bhk_rent;
					$PropertyDescription->security = $request->two_bhk_security;
					$PropertyDescription->description = $request->two_bhk_description;

					$Property_description_id = $PropertyDescription->save();
				}

				if (in_array("three_bhk", $request->flat_type)) {
					$PropertyDescription = new PropertyDescription();
					//$detail=PropertyDescription::where([['property_id',$request->propertyId],['room_type',6]])->first();
					//if($detail)
					//{
					//	PropertyDescription::where('id',$detail->id)->delete();
					//}
					$PropertyDescription->property_id     = $property_id;
					$PropertyDescription->room_type = 14;
					$PropertyDescription->quantity = $request->three_bhk_quantity;
					$PropertyDescription->rent = $request->three_bhk_rent;
					$PropertyDescription->security = $request->three_bhk_security;
					$PropertyDescription->description = $request->three_bhk_description;

					$Property_description_id = $PropertyDescription->save();
				}
				if (in_array("four_bhk", $request->flat_type)) {
					$PropertyDescription = new PropertyDescription();
					//$detail=PropertyDescription::where([['property_id',$request->propertyId],['room_type',6]])->first();
					//if($detail)
					//{
					//	PropertyDescription::where('id',$detail->id)->delete();
					//}
					$PropertyDescription->property_id     = $property_id;
					$PropertyDescription->room_type = 15;
					$PropertyDescription->quantity = $request->four_bhk_quantity;
					$PropertyDescription->rent = $request->four_bhk_rent;
					$PropertyDescription->security = $request->four_bhk_security;
					$PropertyDescription->description = $request->four_bhk_description;

					$Property_description_id = $PropertyDescription->save();
				}
				if (in_array("flat_other", $request->flat_type)) {
				    $PropertyDescription = new PropertyDescription();
					//$detail=PropertyDescription::where([['property_id',$request->propertyId],['room_type',8]])->first();
					//if($detail)
					//{
						//PropertyDescription::where('id',$detail->id)->delete();
					//}
					$PropertyDescription->property_id     = $property_id;
					$PropertyDescription->room_type = 8;
					$PropertyDescription->quantity = $request->other_flat_quantity;
					$PropertyDescription->rent = $request->other_flat_rent;
					$PropertyDescription->security = $request->other_flat_security;
					$PropertyDescription->description = $request->other_flat_description;

					$Property_description_id = $PropertyDescription->save();
				}
			}
            if(!empty($propertyDetailId)){

                return response()->json(['Property_description_id'   => 'property deatils added successfully.']);
            }
        }
    }

    /*
    *
    *save property address information
    *
    */
	public function savePropertyNeighbourhoods(Request $request)
    {//dd( $request);
		$propertyneighbour=PropertyNeighbourhood::where('property_id',$request->propertyId)->get();
        if ($propertyneighbour) {

			$propertyneighbour=PropertyNeighbourhood::where('property_id',$request->propertyId)->delete();
		}

			if($request->area1!="" && $request->distance1!="")
			{
					$Propertyneighbour = new PropertyNeighbourhood();
					$Propertyneighbour->property_id  = $request->propertyId;
					$Propertyneighbour->area = $request->area1;
					$Propertyneighbour->distance = $request->distance1;
					$Propertyneighbour->save();
			}

			if($request->area2!="" && $request->distance2!="")
			{
					$Propertyneighbour = new PropertyNeighbourhood();
					$Propertyneighbour->property_id  = $request->propertyId;
					$Propertyneighbour->area = $request->area2;
					$Propertyneighbour->distance = $request->distance2;
					$Propertyneighbour->save();
			}

			if($request->area3!="" && $request->distance3!="")
			{
					$Propertyneighbour = new PropertyNeighbourhood();
					$Propertyneighbour->property_id  = $request->propertyId;
					$Propertyneighbour->area = $request->area3;
					$Propertyneighbour->distance = $request->distance3;
					$Propertyneighbour->save();
			}

			if($request->area4!="" && $request->distance4!="")
			{
					$Propertyneighbour = new PropertyNeighbourhood();
					$Propertyneighbour->property_id  = $request->propertyId;
					$Propertyneighbour->area = $request->area4;
					$Propertyneighbour->distance = $request->distance4;
					$Propertyneighbour->save();
			}

            if(!empty($Propertyneighbour)){

                return response()->json(['Propertyneighbour'   => $Propertyneighbour->id]);
            }
			else
			{
				return response()->json(['Propertyneighbour'   => 0]);
			}


    }

    public function savePropertyAddressDetails(Request $request)
    {
        if ($request->propertyId) {

			$data = '1234567890';

			if($request->address_city){
				$cities = city::where('id', '=', $request->address_city)->first();
				$cityName   =   $cities->name;
				$propertyCode   =  substr($cityName, 0, 4).substr(str_shuffle($data), 0, 5);

			}else{
				$propertyCode   =   'YOULIV' . substr(str_shuffle($data), 0, 5);
			}

				//$Property = new Property();
				$Property	=	Property::where('id', $request->propertyId)->update([
				'property_code'    =>  $propertyCode
				]);

			$propertyaddress=PropertyAddress::where('property_id',$request->propertyId)->first();
			//dd($request);
			if($propertyaddress)
			{
				$PropertyAddress = new PropertyAddress();
				$PropertyAddress	=	PropertyAddress::where('id', $propertyaddress->id)->update([
				'address_house'    =>  ($request->address_house)?$request->address_house:Null,
				'address_building'    => ($request->address_building)?$request->address_building:Null,
				'address_street'    => ($request->address_street)?$request->address_street:Null,
				'address_sector'    => ($request->address_sector)?$request->address_sector:Null,
				'address_city'    => ($request->address_city)?$request->address_city:Null,
				'address_state'    => ($request->address_state)?$request->address_state:Null,
				'geo_location'    => ($request->geo_location)?$request->geo_location:Null,
				'zipcode'    => ($request->zipcode)?$request->zipcode:Null,
				'lat'    => ($request->property_lat)?$request->property_lat:Null,
				'lng'    => ($request->property_lng)?$request->property_lng:Null,
				]);
				$propertyaddress=$propertyaddress->id;

			}
			else{
				$PropertyAddress = new PropertyAddress();
				$PropertyAddress->property_id = $request->propertyId;
				$PropertyAddress->address_house = ($request->address_house)?$request->address_house:Null;
				$PropertyAddress->address_building = ($request->address_building)?$request->address_building:Null;
				$PropertyAddress->address_street = ($request->address_street)?$request->address_street:Null;
				$PropertyAddress->address_sector = ($request->address_sector)?$request->address_sector:Null;
				$PropertyAddress->address_city = ($request->address_city)?$request->address_city:Null;
				$PropertyAddress->address_state = ($request->address_state)?$request->address_state:Null;
				$PropertyAddress->zipcode = ($request->zipcode)?$request->zipcode:Null;
				$PropertyAddress->geo_location = ($request->geo_location)?$request->geo_location:Null;
				$PropertyAddress->lat = ($request->property_lat)?$request->property_lat:Null;
				$PropertyAddress->lng = ($request->property_lng)?$request->property_lng:Null;
				$PropertyAddress->save();
				$propertyaddress=$PropertyAddress->id;
			}

            if(!empty($PropertyAddress)){

                return response()->json(['PropertyAddress'   => $propertyaddress,'propertyCode'=>$propertyCode]);
            }
        }
    }

    /*
    *
    *save Ameniteis and additional information
    *
    */

    public function savePropertyAdditionalDetails(Request $request)
    {


		if(isset($request->amenities_others))
		{
			$amenities_others=$request->amenities_others;
			$amenities_others_text=$request->amenities_others_text;
		}
		else
		{
			$amenities_others=0;
			$amenities_others_text="";
		}
		$PropertyAddress	=	PropertyDetail::where('property_id', $request->propertyId)->update([
				'amenities_others'    => $request->amenities_others,
				'amenities_others_text'    => $request->amenities_others_text
			]);

        if ($request->propertyId) {

            if (!empty($request->amenities)) {
                $amenities = $request->amenities;
				PropertyAmenities::where('property_id',$request->propertyId)->delete();

                foreach ($amenities  as $ammenity) {
                    $PropertyPropertyAmenities = new PropertyAmenities();
                    $PropertyPropertyAmenities->property_id = $request->propertyId;
                    $PropertyPropertyAmenities->amenities_id = $ammenity;
                    $PropertyPropertyAmenities->save();
                }
            }
			else
			{
				PropertyAmenities::where('property_id',$request->propertyId)->delete();
			}

			if (!empty($request->additional_information)) {
				$informations = $request->additional_information;
				PropertyAdditionalInformation::where('property_id',$request->propertyId)->delete();

				$information_count = 0;
				foreach ($informations  as $information) {
					if ($information_count <= 5) {
						$information_count++;
						if($information!="")
						{
							$PropertyAdditionalInformation = new PropertyAdditionalInformation();
							$PropertyAdditionalInformation->property_id = $request->propertyId;
							$PropertyAdditionalInformation->additional_information = $information;
							$PropertyAdditionalInformation->save();
						}
					}
				}

			}
			else
			{
				PropertyAdditionalInformation::where('property_id',$request->propertyId)->delete();

			}
			  return response()->json(['sucesss'   => "sucesss"]);
            //if(!empty($PropertyAdditionalInformation)){


            //}

        }
    }

    /*
     *   Save Property Images
    */




    public function submit_property(Request $request)
    {

            $data = '1234567890';

            $this->validator($request);

            if($request->address_city){
                $cities = city::where('id', '=', $request->address_city)->first();
                $cityName   =   $cities->name;
                $propertyCode   =  substr($cityName, 0, 4).substr(str_shuffle($data), 0, 5);

            }else{
                $propertyCode   =   'YOULIV' . substr(str_shuffle($data), 0, 5);
            }


        // OwnerImage

        if (!empty($request->property_owner_image)) {
            $property_owner_image = $request->owner_name . '_' . time() . '.' . request()->property_owner_image->getClientOriginalExtension();
            $path = 'assets/img/owner';
            request()->property_owner_image->move(public_path($path), $property_owner_image);
            $propertyOwnerImage =  'public/'.$path . '/' . $property_owner_image;
        }else{
            $propertyOwnerImage =Null;
        }

        // OwnerImage Identity Front Side
        if (!empty($request->property_owner_id_front)) {
            $idFrontSide = $request->owner_name . '_' . time() . '.' . request()->property_owner_id_front->getClientOriginalExtension();
            $path = 'assets/img/ownerIdFrontSide';
            request()->property_owner_id_front->move(public_path($path), $idFrontSide);
            $idFrontSideImage =  'public/'.$path . '/' . $idFrontSide;
        }else{
            $idFrontSideImage   = Null;
        }

        // OwnerImage Identity Back Side

        if (!empty($request->property_owner_id_back)) {
            $idBackSide = $request->owner_name . '_' . time() . '.' . request()->property_owner_id_back->getClientOriginalExtension();
            $path = 'assets/img/ownerIdBackSide';
            request()->property_owner_id_back->move(public_path($path), $idBackSide);
            $idBackSideImage =  'public/'.$path . '/' . $idBackSide;
        }else{
            $idBackSideImage    =  Null ;
        }


        // Digital Signature Upload

        if (!empty($request->digital_signature)) {
            $digital_signature = $request->owner_name . '_' . time() . '.' . request()->digital_signature->getClientOriginalExtension();
            $path = 'assets/img/digital_signature';
            request()->digital_signature->move(public_path($path), $digital_signature);
            $OwnerDigitalSignature =  'public/'.$path . '/' . $digital_signature;
        }else{
            $OwnerDigitalSignature = Null;
        }

        // identity lease_deed image

        if (!empty($request->lease_deed)) {
            $lease_deed = $request->owner_name . '_' . time() . '.' . request()->lease_deed->getClientOriginalExtension();
            $path = 'assets/img/lease_deed';
            request()->lease_deed->move(public_path($path), $lease_deed);
            $OwnerLeaseDeedImage =  'public/'.$path . '/' . $lease_deed;
        }else{
            $OwnerLeaseDeedImage = Null;
        }

        if (!empty($request->property_address_img)) {
            $property_address_img = $request->owner_name . '_' . time() . '.' . request()->property_address_img->getClientOriginalExtension();
            $path = 'assets/img/lease_deed';
            request()->property_address_img->move(public_path($path), $property_address_img);
            $OwnerDiffrentAddrImage =  'public/'.$path . '/' . $property_address_img;
        }else{
            $OwnerDiffrentAddrImage = Null;
        }


        $property = new Property();
        $property->added_by = "1";
        $property->added_by_type = "1";
        $property->area_manager_id = $request->area_manager_id;
        $property->property_code = $propertyCode;
        $property->deals = ($request->deals)?$request->deals:25;
        $property->save();

        $property_id = $property->id;

        if (!empty($property_id)) {


            $ownerData	=	Owner::where('owner_number', $request->owner_number)->first();

            if(!empty($ownerData)){
				$ownData	=	Owner::where('owner_number', $request->owner_number)
					->update([
						'owner_name'   		=> $request->owner_name,
						'alernate_number' 	=> ($request->alernate_number)?$request->alernate_number:Null,
						'owner_email'		=> ($request->owner_email)?$request->owner_email:Null,
						'password'          => Hash::make($request->owner_number),
						'property_owner_image'		=> $propertyOwnerImage,
						'property_owner_id_drop'	=> $request->property_owner_id_drop,
						'property_owner_id_front'	=> $idFrontSideImage,
						'property_owner_id_back'	=> $idBackSideImage,
						'property_gst'	        	=> ($request->property_gst)?$request->property_gst:Null,
						'digital_signature'       	=> $OwnerDigitalSignature
					]);

					$owner_id	=	$ownerData->id;

			}else{

				$owner = new Owner();
				$owner->owner_name   = $request->owner_name;
				$owner->owner_number = $request->owner_number;
				$owner->alernate_number = ($request->alernate_number)?$request->alernate_number:Null;
				$owner->owner_email             = ($request->owner_email)?$request->owner_email:Null;
				$owner->password                = Hash::make($request->owner_number);
				$owner->property_owner_image	= $propertyOwnerImage;
				$owner->property_owner_id_drop	= $request->property_owner_id_drop;
				$owner->property_owner_id_front	= $idFrontSideImage;
				$owner->property_owner_id_back	= $idBackSideImage;
				$owner->property_gst	        = ($request->property_gst)?$request->property_gst:Null;
				$owner->digital_signature       = $OwnerDigitalSignature;
				$owner->save();

				$owner_id = $owner->id;

			}

            if (!empty($owner_id)) {

                $propertyOwner = new PropertyOwner();

                $propertyOwner->owner_id    = $owner_id;
                $propertyOwner->property_id = $property_id;
                $propertyOwner->property_owned = ($request->property_owned)?$request->property_owned:1;
                $propertyOwner->lease_unit = ($request->lease_unit)?$request->lease_unit:Null;
                $propertyOwner->lease_duration = ($request->lease_duration)?$request->lease_duration:Null;
                $propertyOwner->lease_expiry = ($request->lease_expiry)?$request->lease_expiry:Null;
                $propertyOwner->lease_deed= $OwnerLeaseDeedImage;
                $propertyOwner->id_proof_is_same_address = ($request->id_proof_address)?$request->id_proof_address:2;
                $propertyOwner->property_diff_address = ($request->property_diff_address)?$request->property_diff_address:Null;
                $propertyOwner->property_address_img = $OwnerDiffrentAddrImage;
                $propertyOwner->save();

                $propertyOwnerId = $propertyOwner->id;

            }

                //update Property Details

                $propertyDetail = new PropertyDetail();

                $propertyDetail->property_id      =  $property_id;
                $propertyDetail->property_type    =  ($request->property_type)?$request->property_type:1 ;
                $propertyDetail->property_available = ($request->property_available)?$request->property_available: 1 ;
                $propertyDetail->furnishing       =  ($request->furnishing)?$request->furnishing: 1 ;
                $propertyDetail->owner_free      =  ($request->owner_free)?$request->owner_free: 1 ;
                $propertyDetail->total_room_for_rent  = ($request->total_room_for_rent)?$request->total_room_for_rent: Null ;
                $propertyDetail->total_bed_for_rent   = ($request->total_bed_for_rent)?$request->total_bed_for_rent: Null ;
                $propertyDetail->food_inclusive       =  ($request->food_inclusive)?$request->food_inclusive: 1 ;
                $propertyDetail->electricity_inclusive  = ($request->electricity_inclusive)?$request->electricity_inclusive: 1 ;
                $propertyDetail->food_exclusive_rent  = ($request->food_exclusive_price)?$request->food_exclusive_price: Null ;

                $propertyDetail->save();
                $propertyDetailId   =   $propertyDetail->id;

            // Update Property Description
                $PropertyDescription = new PropertyDescription();

                $PropertyDescription->property_id = $property_id;

                if (in_array("single_sharing", $request->room_type)) {

                    $PropertyDescription->room_type     = 1;
                    $PropertyDescription->quantity      = $request->single_sharing_quantity;
                    $PropertyDescription->rent          = $request->single_sharing_rent;
                    $PropertyDescription->security      = $request->single_sharing_security;
                    $PropertyDescription->description   = $request->single_sharing_description;

                    $Property_description_id = $PropertyDescription->save();


                }

                if (in_array("twin_sharing", $request->room_type)) {

                    $PropertyDescription->room_type = 2;
                    $PropertyDescription->quantity = $request->twin_sharing_quantity;
                    $PropertyDescription->rent = $request->twin_sharing_rent;
                    $PropertyDescription->security = $request->twin_sharing_security;
                    $PropertyDescription->description = $request->twin_sharing_description;
                    $Property_description_id = $PropertyDescription->save();


                }

                if (in_array("triple_sharing", $request->room_type)) {

                    $PropertyDescription->room_type = 3;
                    $PropertyDescription->quantity = $request->triple_sharing_quantity;
                    $PropertyDescription->rent = $request->triple_sharing_rent;
                    $PropertyDescription->security = $request->triple_sharing_security;
                    $PropertyDescription->description = $request->triple_sharing_description;

                    $Property_description_id = $PropertyDescription->save();


                }

                if (in_array("other", $request->room_type)) {

                    $PropertyDescription->room_type = 4;
                    $PropertyDescription->quantity = $request->other_room_quantity;
                    $PropertyDescription->rent = $request->other_room_rent;
                    $PropertyDescription->security = $request->other_room_security;
                    $PropertyDescription->description = $request->other_room_description;

                    $Property_description_id = $PropertyDescription->save();


                }


                if (in_array("one_rk", $request->room_type)) {

                    $PropertyDescription->room_type = 5;
                    $PropertyDescription->quantity = $request->one_rk_quantity;
                    $PropertyDescription->rent = $request->one_rk_rent;
                    $PropertyDescription->security = $request->one_rk_security;
                    $PropertyDescription->description = $request->one_rk_description;

                    $Property_description_id = $PropertyDescription->save();


                }


                if (in_array("one_bhk", $request->room_type)) {

                    $PropertyDescription->room_type = 6;
                    $PropertyDescription->quantity = $request->one_bhk_quantity;
                    $PropertyDescription->rent = $request->one_bhk_rent;
                    $PropertyDescription->security = $request->one_bhk_security;
                    $PropertyDescription->description = $request->one_bhk_description;

                    $Property_description_id = $PropertyDescription->save();


                }

                if (in_array("two_bhk", $request->room_type)) {

                    $PropertyDescription->room_type = 7;
                    $PropertyDescription->quantity = $request->two_bhk_quantity;
                    $PropertyDescription->rent = $request->two_bhk_rent;
                    $PropertyDescription->security = $request->two_bhk_security;
                    $PropertyDescription->description = $request->two_bhk_description;

                    $Property_description_id = $PropertyDescription->save();


                }

                if (in_array("flat_other", $request->room_type)) {

                    $PropertyDescription->room_type = 8;
                    $PropertyDescription->quantity = $request->other_flat_quantity;
                    $PropertyDescription->rent = $request->other_flat_rent;
                    $PropertyDescription->security = $request->other_flat_security;
                    $PropertyDescription->description = $request->other_flat_security;

                    $Property_description_id = $PropertyDescription->save();


                }
                //$Property_description_id = $PropertyDescription->save();


                // Save Additional Information
                $informations = $request->additional_information;
                $information_count = 0;
                foreach ($informations  as $information) {
                    if ($information_count <= 5) {
                        $information_count++;
                        $PropertyAdditionalInformation = new PropertyAdditionalInformation();
                        $PropertyAdditionalInformation->property_id = $property_id;
                        $PropertyAdditionalInformation->additional_information = $information;
                        $PropertyAdditionalInformation->save();
                    }
                }

                // Save Address
                $PropertyAddress = new PropertyAddress();
                $PropertyAddress->property_id = $property_id;
                $PropertyAddress->address_house = ($request->address_house)?$request->address_house:Null;
                $PropertyAddress->address_building = ($request->address_building)?$request->address_building:Null;
                $PropertyAddress->address_street = ($request->address_street)?$request->address_street:Null;
                $PropertyAddress->address_sector = ($request->address_sector)?$request->address_sector:Null;
                $PropertyAddress->address_city = ($request->address_city)?$request->address_city:Null;
                $PropertyAddress->address_state = ($request->address_state)?$request->address_state:Null;
                $PropertyAddress->zipcode = ($request->zipcode)?$request->zipcode:Null;
                $PropertyAddress->lat = ($request->property_lat)?$request->property_lat:Null;
                $PropertyAddress->lng = ($request->property_lng)?$request->property_lng:Null;
                $PropertyAddress->save();


                // Save Property Images

                $propertyImages = new PropertyImages();
                $imagesArray    =   explode(",",$request->imagesArray);

                if (!empty($imagesArray)) {
                    foreach ($imagesArray as $property_image) {


                        $propertyImages = new PropertyImages();
                        $propertyImages->property_id = $property_id;
                        $propertyImages->image = $property_image;
                        $propertyImages->save();
                    }
                }


                 // Save Amenities
                if (!empty($request->amenities)) {
                    $amenities = $request->amenities;
                    foreach ($amenities  as $ammenity) {
                        $PropertyPropertyAmenities = new PropertyAmenities();
                        $PropertyPropertyAmenities->property_id = $property_id;
                        $PropertyPropertyAmenities->amenities_id = $ammenity;
                        //$PropertyPropertyAmenities->amenities_id = 1;
                        $PropertyPropertyAmenities->save();
                    }
                }
        }

        return redirect('/admin/property_list');
    }



    public function property_list(Request $request)
    {
		$properties=array();
		$verified="Non-Verified";
		$owner_name=$owner_number=$owner_id="";
		$property_type=$gender="";

		$address_city=$address_sector=$address_state="";
		$id=$request->id;
		if($request->type=="area_manager")
		{
        $list    =  Property::with(['property_descriptions'=> function($query){ $query->select('room_type','description','rent','property_id');}])
		->with(['property_addresses'=> function($query){ $query->select('address_house','address_building','zipcode','address_sector','address_city','address_state','property_id');}])
		->with(['property_details'=> function($query){ $query->select('property_available_women','property_available_men','property_available_unisex','property_available_family','property_type','featured','property_id')->orderBy('featured');}])
		->with(['property_owners'=> function($query){ $query->select('owner_id','property_id');}])->orderBy('property.id', 'desc')->where('area_manager_id',$id)->get();
		}
		elseif($request->type=="owner")
		{
        $list    =  Property::with(['property_descriptions'=> function($query){ $query->select('room_type','description','rent','property_id');}])
		->with(['property_addresses'=> function($query){ $query->select('address_house','address_building','zipcode','address_sector','address_city','address_state','property_id');}])
		->with(['property_details'=> function($query){ $query->select('property_available_women','property_available_men','property_available_unisex','property_available_family','property_type','featured','property_id')->orderBy('featured');}])
		->with(['property_owners'=> function($query) { $query->select('owner_id','property_id');}])->whereHas('property_owners', function($q) use($id) { $q->where('owner_id','=', $id);})->orderBy('property.id', 'desc')->get();
		}
		else
		{
		$list    =  Property::with(['property_descriptions'=> function($query){ $query->select('room_type','description','rent','property_id');}])
		->with(['property_addresses'=> function($query){ $query->select('address_house','address_building','zipcode','address_sector','address_city','address_state','property_id');}])
		->with(['property_details'=> function($query){ $query->select('property_available_women','property_available_men','property_available_unisex','property_available_family','property_type','featured','property_id')->orderBy('featured');}])
		->with(['property_owners'=> function($query){ $query->select('owner_id','property_id','id_proof_is_same_address','property_address_img');}])->orderBy('property.id', 'desc')->get();
		}

		foreach($list as $key=>$value)
		{
			$property_type=$gender="";
			if(isset($value->property_owners->owner_id))
			{
				$owner=Owner::where([['id',$value->property_owners->owner_id]])->select('owner_name','owner_number','property_owner_id_drop','property_owner_id_front','property_owner_id_back')->first();
				if($owner->property_owner_id_drop!="" && $owner->property_owner_id_front!="" && $owner->property_owner_id_back!="")
				{
					if($value->property_owners->id_proof_is_same_address==1	)
					{
						$verified="Verified";
					}
					elseif($value->property_owners->id_proof_is_same_address==2)
					{
						 if($value->property_owners->property_address_img!="")
						 {
							 $verified="Verified";
						 }
					}
					else
					{
						$verified="Non Verified";
					}
				}
				
				$owner_id=$value->property_owners->owner_id;
				$owner_name=$owner->owner_name;
				$owner_number=$owner->owner_number;
			}
			if(isset($value->property_details->featured))
			{
				$featured=($value->property_details->featured==1? "Yes": "No");

				$property_type=($value->property_details->property_type==1? "Flat" : ($value->property_details->property_type==2? 'PG': "Flat/PG"));
				if($value->property_details->property_available_women==1)
				{
					if($gender!="")
					{
						$gender.=", Women";
					}
					else{
						$gender.="Women";
					}
				}
				if($value->property_details->property_available_men==1)
				{
					if($gender!="")
					{
						$gender.=", Men";
					}
					else{
						$gender.="Men";
					}
				}
				if($value->property_details->property_available_unisex==1)
				{
					if($gender!="")
					{
						$gender.=", Unisex";
					}
					else{
						$gender.="Unisex";
					}
				}
				if($value->property_details->property_available_family==1)
				{

					if($gender!="")
					{
						$gender.=", Family";
					}
					else{
						$gender.="Family";
					}
				}
			}
			else
			{
				$featured="No";
			}
			$area_manager=AreaManager::where([['id',$value->area_manager_id]])->select('name','phone')->first();
			if(isset($value->property_addresses->address_city))
			{
				$city=City::where([['id',$value->property_addresses->address_city]])->select('name')->first();
				$city=$city->name;
			}
			else
			{
				$city="";
			}
			$properties[]=array('gender'=>$gender,'property_type'=>$property_type,'status'=>$value->status,'id'=>$value->id,'owner_id'=>$owner_id,'area_manager_id'=>$value->area_manager_id,'property_code'=>$value->property_code,'owner_name'=>$owner_name,'owner_number'=>$owner_number,'area_manager'=>$area_manager->name,'area_manager_phone'=>$area_manager->phone,'verified'=>$verified,'city'=>$city,'featured'=>$featured);
		}

		//dd($properties);
		return view("admin.property.property_list",compact('properties'));

    }

    public function property_list_data()
    {
        //$properties = Property::select('property.*','owners.owner_name')->join('property_owners','property.id','=','property_owners.property_id')->join('owners','owners.id','=','property_owners.owner_id')->orderBy('property.id', 'desc')->get()->toArray();
		$list=array();

		$address_city=$address_sector=$address_state="";
        $properties    =  Property::where('status',1)->with(['property_descriptions'=> function($query){ $query->select('room_type','description','rent','property_id');}])
		->with(['property_images'=> function($query){ $query->select('image','property_id');}])->with(['property_addresses'=> function($query){ $query->select('address_house','address_building','zipcode','address_sector','address_city','address_state','property_id');}])
		->with(['property_details'=> function($query){ $query->select('property_type','furnishing','total_room_for_rent','total_bed_for_rent','property_available_men','property_available_unisex','property_available_women','property_available_family','property_id');}])->paginate(20);



		return view("admin.property.property_list",compact('properties'));
        
    }

    public function propertyStatus($id,$statusId)
    {
        try{
            if(Auth::guard('admin')->user()){
              //  $id         =   base64_decode($id);
              //  $statusId   =   base64_decode($statusId);

                if($statusId =="Unpublish"){
                    Property::where('id', $id)->update(['status'  => 2]);
                    return response()->json(['status' => 'success']);
                }elseif($statusId =="Publish"){
                    Property::where('id', $id)->update(['status'  => 1]);
                    return response()->json(['status' => 'success']);
                }
            }else{
               return response()->json(['status' => 'failure']);
            }

        }catch(Exception $e){
            return $e->getMessage();
        }



    }

    public function property_detail($id)
    {
        //$id = base64_decode($id);
		$property_owner_id_drop="";
		$property_owner_id_front="";
		$property_owner_id_back=$property_gst="";
		 $amenities=array();

        $propertyData = Property::select('property.*')->with(['property_amenities'=>function($query){ $query->select('property_id','amenities_id');}])->
       with(['property_additional_information'=>function($query){ $query->select('property_id','additional_information');}])
       ->with(['property_images'=> function($query){ $query->select('image','property_id');}])
	   ->with(['property_descriptions'=> function($query){ $query->select('room_type','description','rent','property_id','quantity');}])
	   ->with('property_details')
	   ->with('property_owners')
	   ->with('property_addresses')
	   ->with('property_digital_signature')
	   ->with('property_neighbourhood')
	   ->where('property.id',$id)
        ->get()->first();
		//dd($propertyData);
		//dd($propertyData );
		$verified="Non Verified";
		 $property_manager = AreaManager::where('id',$propertyData->area_manager_id)->first();
		 if(isset($propertyData->property_owners->owner_id))
			{
				$property_owner=Owner::where([['id',$propertyData->property_owners->owner_id]])->select('owner_email','alernate_number','owner_name','owner_number','property_owner_id_drop','property_owner_id_front','property_owner_id_back','property_gst')->first();
				if($property_owner->property_owner_id_drop!="" && $property_owner->property_owner_id_front!="" && $property_owner->property_owner_id_back!="")
				{
					if($propertyData->property_owners->id_proof_is_same_address==1	)
					{
						$verified="Verified";
					}
					elseif($propertyData->property_owners->id_proof_is_same_address==2)
					{
						 if($propertyData->property_owners->property_address_img!="")
						 {
							 $verified="Verified";
						 }
					}
					else
					{
						$verified="Non Verified";
					}
				}
				$property_owner_id_drop=$property_owner->property_owner_id_drop;
				$property_owner_id_front=$property_owner->property_owner_id_front;
				$property_owner_id_back=$property_owner->property_owner_id_back;
				$property_gst=$property_owner->property_gst;
			}
		if(isset($propertyData->property_amenities))
		{
			foreach($propertyData->property_amenities as $key=>$value)
			{
				$property_amenities=Amenties::where([['id',$value->amenities_id]])->first();
				$amenities[]=array('name'=>$property_amenities->name,'image'=>$property_amenities->image);
			}
		}



        if(!empty($propertyData)){
            return view("admin.property.property_detail",compact('property_gst','propertyData','amenities','property_manager','property_owner','verified','property_owner_id_drop','property_owner_id_front','property_owner_id_back'));
        }else{
            return back()->with('No record found');
        }
    }
  
    public function getAreaManagerInfo($id)
    {
        $manager_info = AreaManager::where('id', '=', $id)->get()->first();
        return response()->json($manager_info);
    }

    // Dropzone Multi File Upload
  public function savePropertyImages(Request $request)
    {

        if ($request->propertyId) {

            $propertyImages = new PropertyImages();
			//dd($request->imagesArray);
            $imagesArray    =   explode(",", $request->imagesArray);

            if (!empty($imagesArray)) {
				/*$images=PropertyImages::select('image')->where('property_id',$request->propertyId)->get();
				if($images)
				{
					foreach($images as $key=>$image)
					{
						if (File::exists('public/assets/img/property_images/'.$image->images)) {
							unlink('public/assets/img/property_images/'.$image->images);
						}
					}
				}
				PropertyImages::where('property_id',$request->propertyId)->delete();*/
                foreach ($imagesArray as $property_image) {
                    $propertyImages = new PropertyImages();
                    $propertyImages->property_id = $request->propertyId;
                    $propertyImages->image = $property_image;
                    $propertyImages->save();
                }
                if(!empty($propertyImages)){

                    return response()->json(['propertyImages'   => $propertyImages->id]);
                }
            }
        }
    }
    function upload12(Request $request)
    {

        $images = $request->file('file');

		$watermarkImagePath = public_path('app_asset/images/watermark.png');
		$path = 'assets/img/property_images/';

		$watermarkImg = imagecreatefrompng($watermarkImagePath);
		$list=array();

        foreach ($images as $image) {
				$fileType=$image->getClientOriginalExtension();
				$getImageName = time() . '.' . $image->getClientOriginalExtension();
				$targetFilePath = public_path($path) .  $getImageName;

				$image->move(public_path($path), $getImageName);

				//$img_to_resize = image_resize($targetFilePath, 250, 250);


				switch($fileType){
                    case 'jpg':
                        $im = imagecreatefromjpeg($targetFilePath);
                        break;
                    case 'jpeg':
                        $im = imagecreatefromjpeg($targetFilePath);
                        break;
                    case 'png':
                        $im = imagecreatefrompng($targetFilePath);
                        break;
                    default:
                        $im = imagecreatefromjpeg($targetFilePath);
                }

			 // Set the margins for the watermark


            $marge_right = 25;
			$marge_bottom = 25;

			// Get the height/width of the watermark image
			$sx = imagesx($watermarkImg);
			$sy = imagesy($watermarkImg);
			list($width, $height) = getimagesize($targetFilePath);
			 $newwidth = 775;
			$newheight = 516;
			// Copy the watermark image onto our photo using the margin offsets and
			// the photo width to calculate the positioning of the watermark.
			$thumb = imagecreatetruecolor($newwidth, $newheight);
			imagecopyresized($thumb, $im, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

			imagecopy($thumb, $watermarkImg, imagesx($thumb) - $sx - $marge_right, imagesy($thumb) - $sy - $marge_bottom, 0, 0, imagesx($watermarkImg), imagesy($watermarkImg));
			// Resize


			// Save image and free memory
			imagepng($im, $targetFilePath);

			//imagedestroy($im);
			$imageName =  'public/'.$path . '' . $getImageName;

           //// $image->move(public_path($path), $getImageName);
            //$imageName =  url($path . '/' . $getImageName);
            //$imageName =  'public/'.$path . '/' . $getImageName;
			array_push($list,$imageName);
        }
		  return response()->json(['success' => $list]);
    }
	function image_resize($file_name, $width, $height, $crop=FALSE) {
	   list($wid, $ht) = getimagesize($file_name);
	   $r = $wid / $ht;
	   if ($crop) {
		  if ($wid > $ht) {
			 $wid = ceil($wid-($width*abs($r-$width/$height)));
		  } else {
			 $ht = ceil($ht-($ht*abs($r-$w/$h)));
		  }
		  $new_width = $width;
		  $new_height = $height;
	   } else {
		  if ($width/$height > $r) {
			 $new_width = $height*$r;
			 $new_height = $height;
		  } else {
			 $new_height = $width/$r;
			 $new_width = $width;
		  }
	   }
	   $source = imagecreatefromjpeg($file_name);
	   $dst = imagecreatetruecolor($new_width, $new_height);
	   image_copy_resampled($dst, $source, 0, 0, 0, 0, $new_width, $new_height, $wid, $ht);
	   return $dst;
	}

	public function upload(Request $request)
	{


		$images = $request->file('file');
		$path = 'assets/img/property_images';

		$list=array();
		$i=0;
        foreach ($images as $image) {

			//$input['imagename'] = time().'.'.$image->getClientOriginalExtension();
			$getImageName = time() . '_'.$i.'.' . $image->getClientOriginalExtension();

			$targetFilePath = public_path($path);
			//$image->move($targetFilePath, $getImageName);
			$img = Image::make($image->getRealPath());
			$img->resize(700, 500);
			$img->insert(public_path('app_asset/images/watermark.png'), 'bottom-right', 20, 20)->save($targetFilePath.'/'.$getImageName);
			//$image->move($path, $getImageName);
			$savepathImageName="public/assets/img/property_images".'/'.$getImageName;
			array_push($list,$savepathImageName);
			$i++;
		}

		 return response()->json(['success' => $list]);
	}
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
    }

   function delete(Request $request,$id)
    {
        if (Property::where('id',$id)->exists()) {
			Property::where('id',$id)->delete();
			PropertyDescription::where('property_id',$id)->delete();
			PropertyOwner::where('property_id',$id)->delete();
			PropertyDetail::where('property_id',$id)->delete();
			PropertyImages::where('property_id',$id)->delete();//
			PropertyAdditionalInformation::where('property_id',$id)->delete();//
			PropertyAmenities::where('property_id',$id)->delete();//
			PropertyDigitalSignature::where('property_id',$id)->delete();
			PropertyAddress::where('property_id',$id)->delete();
			return response()->json(['status' => 'success']);
		}
		else {
		  return response()->json(['status' => 'failure']);
		}
    }
	function image_delete_property(Request $request)
	{
		if (PropertyImages::where('id',$request->id)->exists()) {
			$images=PropertyImages::where('id',$request->id)->first();
			if (File::exists('public/assets/img/property_images/'.$images->image)) {
				unlink('public/assets/img/property_images/'.$images->image);
			}
			PropertyImages::where('id',$request->id)->delete();
			return response()->json(['status' => 'success']);
		}
		else {
		  return response()->json(['status' => 'failure']);
		}
	}
	 public function edit($id)
    {
        //$id = base64_decode($id);
		$property_owner_id_drop="";
		$property_owner_id_front="";
		$property_owner_id_back=$property_gst="";
		 $amenities=array();

        $propertyData = Property::select('property.*')->with(['property_amenities'=>function($query){ $query->select('property_id','amenities_id');}])->
       with(['property_additional_information'=>function($query){ $query->select('property_id','additional_information');}])
       ->with(['property_images'=> function($query){ $query->select('image','property_id','id');}])
	   ->with(['property_descriptions'=> function($query){ $query->select('room_type','description','rent','property_id','quantity');}])
	   ->with('property_details')
	   ->with('property_owners')
	   ->with('property_addresses')
	   ->with('property_digital_signature')
	   ->with('property_neighbourhood')
	   ->where('property.id',$id)
        ->get()->first();
		$verified="Non Verified";
		$property_manager = AreaManager::where('id',$propertyData->area_manager_id)->first();
		$city=array();
		$state = State::get();
        $sector =array();
		if(isset($propertyData->property_addresses->address_state))
		{
			$city = City::where('state_id',$propertyData->property_addresses->address_state)->get();
		}

		if(isset($propertyData->property_addresses->address_city))
		{
			$sector = Sector::where('city_id',$propertyData->property_addresses->address_city)->get();
		}
		$owners_list=array();
        $amenity = Amenties::orderBy('id', 'asc')->get();
		$owners_details = Owner::select('id','owner_name','owner_number')->get();
		foreach($owners_details as $key=>$value)
		{
			$owners_list[]=array('id'=>$value->id,'name'=>$value->owner_number.'('.$value->owner_name.')');
		}
		$amenities_list=$property_descript_list=array();
		if(isset($propertyData->property_amenities))
		{
			foreach($propertyData->property_amenities as $key=>$value)
			{
				array_push($amenities_list,$value->amenities_id);
			}
		}
		if(isset($propertyData->property_descriptions))
		{
			foreach($propertyData->property_descriptions as $key=>$value)
			{
				array_push($property_descript_list,$value->room_type);
			}
		}
		//dd($owners_list);
        $area_managers = AreaManager::get()->toArray();
//dd($propertyData);
        if(!empty($propertyData)){
            return view("admin.property.edit_property",compact('propertyData','property_manager','sector','state','city','area_managers','amenity','owners_list','amenities_list','property_descript_list'));
        }else{
            return back()->with('No record found');
        }
    }


	public function  bulk_upload_property(Request $request)
    {
		$messages= "";
		$warning="";
	
		if($request->isMethod('post'))
		{
			try{
				$sheets = Sheets::spreadsheet($request->spreadsheet_id)->sheetById($request->sheet_id)->all();
				$property=array();
				if(count($sheets)>0)
				{
					$i=0;
					foreach($sheets as $key=>$value)
					{
						if($key==0)
						{/*
							foreach($value as $key=>$value1)
							{
								if($value1=="Area Manager")
								{
									$property[0]="area_manager_id";
								}
								if($value1=="Owner Detail")
								{
									$property[1]="owner_id";
								}
								if($value1=="Property Title")
								{
									$property[2]="property_title";
								}
								if($value1=="Property About")
								{
									$property[3]="property_about";
								}
								if($value1=="House Address")
								{
									$property[4]="address_house";
								}
								if($value1=="Building Address")
								{
									$property[5]="address_building";
								}
								if($value1=="Street Address")
								{
									$property[6]="address_street";
								}
								if($value1=="Sector")
								{
									$property[7]="address_sector";
								}
								if($value1=="City")
								{
									$property[8]="address_city";
								}
								if($value1=="State")
								{
									$property[9]="address_state";
								}
								if($value1=="Zipcode")
								{
									$property[10]="zipcode";
								}
								if($value1=="Property Type")
								{
									$property[11]="property_type";
								}
								if($value1=="Furnishing")
								{
									$property[12]="furnishing";
								}
								if($value1=="Amenties")
								{
									$property[13]="Amenties";
								}
								if($value1=="Room Type")
								{
									$property[14]="room_type";
								}
								if($value1=="Room Description")
								{
									$property[15]="room_description";
								}
								if($value1=="Room Quantity")
								{
									$property[16]="room_quantity";
								}
								if($value1=="Room Rent")
								{
									$property[17]="room_rent";
								}
								if($value1=="Room Security")
								{
									$property[18]="room_security";
								}
								if($value1=="Owner Free")
								{
									$property[19]="owner_free";
								}
								if($value1=="Total Rent For Room")
								{
									$property[20]="total_room_for_rent ";
								}
								if($value1=="Total Rent For Flat")
								{
									$property[21]="total_bed_for_rent ";
								}
								if($value1=="Food Inclusive")
								{
									$property[22]="food_inclusive ";
								}
								if($value1=="Food Exclusive")
								{
									$property[23]="food_exclusive";
								}
								if($value1=="Electricity Inclusive")
								{
									$property[24]="electricity_inclusive";
								}
								if($value1=="Water Inclusive")
								{
									$property[25]="water_inclusive";
								}
								if($value1=="Food Exclusive Rent")
								{
									$property[26]="food_exclusive_rent";
								}
								if($value1=="Available For Women")
								{
									$property[27]="property_available_women";
								}
								if($value1=="Available For Unisex")
								{
									$property[28]="property_available_unisex";
								}
								if($value1=="Available For Family")
								{
									$property[29]="property_available_family";
								}
								if($value1=="Available For Men")
								{
									$property[30]="property_available_men";
								}
								if($value1=="Neighbourhood Distance")
								{
									$property[31]="neighbourhood_distance";
								}
								if($value1=="Neighbourhood Area")
								{
									$property[32]="neighbourhood_area";
								}
								if($value1=="Featured")
								{
									$property[33]="featured";
								}
								if($value1=="Status")
								{
									$property[34]="status";
								}
								if($value1=="Additional Information 1")
								{
									$property[35]="additional_information_1";
								}
								if($value1=="Additional Information 2")
								{
									$property[36]="additional_information_2";
								}
								if($value1=="Additional Information 3")
								{
									$property[37]="additional_information_3";
								}
								if($value1=="Additional Information 4")
								{
									$property[38]="additional_information_4";
								}
							}*/
						}
						else
						{						
							foreach($value as $key=>$value1)
							{
								if($key==0)
								{
									$property[$i]['area_manager_id']=$value1;
								}
								if($key==1)
								{
									$property[$i]['owner_id']=$value1;
								}
								if($key==2)
								{
									$property[$i]['property_title']=$value1;
								}
								if($key==3)
								{
									$property[$i]['property_about']=$value1;
								}
								if($key==4)
								{
									$property[$i]['address_house']=$value1;
								}
								if($key==5)
								{
									$property[$i]['address_building']=$value1;
								}
								if($key==6)
								{
									$property[$i]['address_street']=$value1;
								}
								if($key==7)
								{							
									$property[$i]['address_sector']=$value1;
								}
								if($key==8)
								{
									$property[$i]['address_city']=$value1;
								}
								if($key==9)
								{							
									$property[$i]['address_state']=$value1;
								}
								if($key==10)
								{
									$property[$i]['zipcode']=$value1;
								}
								if($key==11)
								{
									$property[$i]['property_type']=$value1;
								}
								if($key==12)
								{
									$property[$i]['furnishing']=$value1;
								}
								if($key==13)
								{
									$property[$i]['amenities']=$value1;
								}
								if($key==14)
								{
									$property[$i]['room_type']=$value1;
								}
								if($key==15)
								{
									$property[$i]['room_description']=$value1;
								}
								if($key==16)
								{
									$property[$i]['room_quantity']=$value1;
								}
								if($key==17)
								{
									$property[$i]['room_rent']=$value1;
								}
								if($key==18)
								{
									$property[$i]['room_security']=$value1;
								}
								if($key==19)
								{
									$property[$i]['owner_free']=$value1;
								}
								if($key==20)
								{
									$property[$i]['total_room_for_rent']=$value1;
								}
								if($key==21)
								{
									$property[$i]['total_bed_for_rent']=$value1;
								}
								if($key==22)
								{
									$property[$i]['food_inclusive']=$value1;
								}
								if($key==23)
								{
									$property[$i]['food_exclusive']=$value1;
								}
								if($key==24)
								{
									$property[$i]['electricity_inclusive']=$value1;
								}
								if($key==25)
								{
									$property[$i]['water_inclusive']=$value1;
								}
								if($key==26)
								{
									$property[$i]['food_exclusive_rent']=$value1;
								}
								if($key==27)
								{
									$property[$i]['property_available_women']=$value1;							
								}
								if($key==28)
								{
									$property[$i]['property_available_unisex']=$value1;
								}
								if($key==29)
								{
									$property[$i]['property_available_family']=$value1;
								}
								if($key==30)
								{
									$property[$i]['property_available_men']=$value1;
								}
								if($key==31)
								{
									$property[$i]['neighbourhood_distance']=$value1;
								}
								if($key==32)
								{
									$property[$i]['neighbourhood_area']=$value1;
								}
								
								if($key==33)
								{							
									$property[$i]['additional_information_1']=$value1;
								}
								if($key==34)
								{							
									$property[$i]['additional_information_2']=$value1;
								}
								if($key==35)
								{						
									$property[$i]['additional_information_3']=$value1;
								}
								if($key==36)
								{							
									$property[$i]['additional_information_4']=$value1;
								}
								if($key==37)
								{							
									$property[$i]['featured']=$value1;
								}
								if($key==38)
								{						
									$property[$i]['amenities_others_text']=$value1;
								}
								if($key==39)
								{							
									$property[$i]['property_owned']=$value1;
								}
								if($key==40)
								{						
									$property[$i]['lease_unit']=$value1;
								}
								if($key==41)
								{							
									$property[$i]['lease_duration']=$value1;
								}
								if($key==42)
								{						
									$property[$i]['lease_expiry']=$value1;
								}
								if($key==43)
								{							
									$property[$i]['lease_deed']=$value1;
								}						
								if($key==44)
								{							
									$property[$i]['id_proof_is_same_address']=$value1;
								}
								if($key==45)
								{						
									$property[$i]['property_diff_address']=$value1;
								}
								if($key==46)
								{						
									$property[$i]['status']=$value1;
								}
								
							}
							$i++;	
						}
				
					}
					//dd($property);
					foreach($property as $key=>$value)
					{
						$authId =   Auth::guard('admin')->user()->id;

						$data = '1234567890';
						$propertyCode="";
						
						if($value['address_city']){
							$cities = city::where('name', '=', $value['address_city'])->first();
							if($cities)
							{
								$cityName   =   $cities->name;
								$propertyCode   =  substr($cityName, 0, 4).substr(str_shuffle($data), 0, 5);
							}
							else
							{
								$propertyCode   =   'YOULIV' . substr(str_shuffle($data), 0, 5);
							}

						}else{
							$propertyCode   =   'YOULIV' . substr(str_shuffle($data), 0, 5);
						}
						
						// Property 
						
						$property = new Property();
						$property->added_by = $authId;
						$property->added_by_type = "1";
						$property->status = ($value['status']=="Active" ? 1: 0);
						$areamanager = AreaManager::where('name', '=', $value['area_manager_id'])->first();
						if($areamanager)
						{
							$property->area_manager_id = $areamanager->id;
						}
						else
						{
							$areamanager = AreaManager::first();
							$property->area_manager_id = $areamanager->id;
						}
						$property->property_code = $propertyCode;
						$property->deals = 25;
						$property->save();
						$propertyId = $property->id;
					  
						//
						$info=array();
						
						for ($i=1;$i<=4;$i++) {
							$informations = $value['additional_information_'.$i];
							if($informations!="")
							{
								$info[]=array('additional_information'=>$value['additional_information_'.$i],'property_id'=>$propertyId);						
							}
						}				
						if(count($info)>0)
						{
							//$save=PropertyAdditionalInformation::insert($info);
						}
						
						//Property Address
						
						$sector = Sector::where([['city_id', '=', $cities->id],['name',$value['address_sector']]])->first();
						$state = State::where('name', '=', $value['address_state'])->first();
						$PropertyAddress = new PropertyAddress();
						$PropertyAddress->property_id = $propertyId;
						$PropertyAddress->address_house = ($value['address_house'])?$value['address_house']:Null;
						$PropertyAddress->address_building = ($value['address_building'])?$value['address_building']:Null;
						$PropertyAddress->address_street = ($value['address_street'])?$value['address_street']:Null;
						$PropertyAddress->address_sector = ($sector->id)?$sector->id:Null;
						$PropertyAddress->address_city = ($cities->id)?$cities->id:Null;
						$PropertyAddress->address_state = ($state->id)?$state->id:Null;
						$PropertyAddress->zipcode = ($value['zipcode'])?$value['zipcode']:Null;
						$find=$value['address_sector'].",".$value['address_city'].",".$value['address_state'];
						$address = str_replace(" ", "+", $find);
						$json = file_get_contents("https://maps.googleapis.com/maps/api/geocode/json?address=".$address."&key=AIzaSyDNB522DKb2l2rwmHv4zcL7OgGEM-b5_cA");
						$json = json_decode($json,true);
						$lat=$json['results'][0]['geometry']['location']['lat'];$lng=$json['results'][0]['geometry']['location']['lng'];
						$PropertyAddress->lat = ($lat)?$lat:Null;
						$PropertyAddress->lng = ($lng)?$lng:Null;
						//$PropertyAddress->save();
						
						
						//Property Ameniteis
						
						$amenity=$value['amenities'];
						$list_amnities=array();
						$amenities=array_map('trim', explode(',', $amenity));
						$in_array=array();
						if(count($amenities)>0)
						{
							foreach($amenities as $key=>$amen_value)
							{
								if(!in_array($amen_value,$in_array))
								{
									array_push($in_array,$amen_value);
									$amt=Amenties::where('name',$amen_value)->first();
									if($amt)
									{
										$list_amnities[]=array('property_id'=>$propertyId,'amenities_id'=>$amt->id);
									}
								}
							}
							
							//$save=PropertyAmenities::insert($list_amnities);
						}
						
						//Property Ameniteis
						
						
						$room_description=array_map('trim', explode(',', $value['room_description']));
						$room_rent=array_map('trim', explode(',', $value['room_rent']));
						$room_security=array_map('trim', explode(',', $value['room_security']));
						$room_quantity=array_map('trim', explode(',', $value['room_quantity']));
						$room_type=array_map('trim', explode(',', $value['room_type']));
						$rooms=array();
						if(count($room_description)>0)
						{
							foreach($room_description as $key=>$room_value)
							{						
								$rooms[]['description']=$room_value;
														
							}					
						}
						
						if(count($room_rent)>0)
						{
							foreach($room_rent as $key=>$room_value)
							{						
								$rooms[$key]['rent']=$room_value;
								$rooms[$key]['property_id']=$propertyId;	
							}
							
						}
						if(count($room_security)>0)
						{
							foreach($room_security as $key=>$room_value)
							{						
								$rooms[$key]['security']=$room_value;	
							}
							
						}
						if(count($room_quantity)>0)
						{
							foreach($room_quantity as $key=>$room_value)
							{						
								$rooms[$key]['quantity']=$room_value;	
							}
							
						}
						if(count($room_type)>0)
						{
							foreach($room_type as $key=>$room_value)
							{						
								if($room_value=="Single Room"){$type=1;}	else if($room_value=="Twin Sharing Room"){$type=2;}	else if($room_value=="Triple Sharing Room"){$type=3;}	
								else if($room_value=="Other Room"){$type=4;} else if($room_value=="1 RK"){$type=5;}	else if($room_value=="1 BHK"){$type=6;}	
								else if($room_value=="2 BHK"){$type=7;}	else if($room_value=="Other Room"){$type=8;}	else if($room_value=="3 BHK"){$type=14;}	
								else if($room_value=="4 BHK"){$type=15;} else if($room_value=="One Room"){$type=9;}	else if($room_value=="Two Room"){$type=10;} if ($room_value=="Three Room"){$type=13;}						
								$rooms[$key]['room_type']=$type;	
							}
							
						}
						
						//dd($rooms);				
						//$save=PropertyDescription::insert($rooms);
						
						
						
						//property_neighbourhoods
						$neighbourhood_distance=array_map('trim', explode(',', $value['neighbourhood_distance']));
						$neighbourhood_area=array_map('trim', explode(',', $value['neighbourhood_area']));
						
						$neighbourhood=array();
						if(count($neighbourhood_distance)>0)
						{
							foreach($neighbourhood_distance as $key=>$neighbourhood_value)
							{						
								$neighbourhood[]['distance']=$neighbourhood_value;												
							}					
						}
						
						if(count($neighbourhood_area)>0)
						{
							foreach($neighbourhood_area as $key=>$neighbourhood_value)
							{						
								$neighbourhood[$key]['area']=$neighbourhood_value;
								$neighbourhood[$key]['property_id']=$propertyId;	
							}					
						}
						
						$save=PropertyNeighbourhood::insert($neighbourhood);
						
						
						$PropertyDetail = new PropertyDetail();
						$PropertyDetail->property_id = $propertyId;
						$PropertyDetail->property_type = ($value['property_type']=="Flat" ) ? 1 : ($value['property_type']=="PG" ? 2: 3 );
						$PropertyDetail->furnishing = ($value['furnishing']=="Fully Furnished")? 3 : ($value['property_type']=="Semi Furnished" ? 2: 1 );
						$PropertyDetail->owner_free = ($value['owner_free']=="Yes")? 1 : 2 ;
						$PropertyDetail->food_inclusive = ($value['food_inclusive']=="Yes")? 1 : 2 ;
						$PropertyDetail->food_exclusive = ($value['food_exclusive']=="Yes")? 1 : 2 ;
						$PropertyDetail->water_inclusive = ($value['water_inclusive']=="Yes")? 1 : 2 ;
						$PropertyDetail->featured = ($value['featured']=="Yes")? 1 : 0 ;
						$PropertyDetail->electricity_inclusive = ($value['electricity_inclusive']=="Yes")? 1 : 2 ;
						$PropertyDetail->property_available_women = ($value['property_available_women']=="Yes")? 1 : Null ;
						$PropertyDetail->property_available_unisex = ($value['property_available_unisex']=="Yes")? 1 : Null ;
						$PropertyDetail->property_available_family = ($value['property_available_family']=="Yes")? 1 : Null ;
						$PropertyDetail->property_available_men = ($value['property_available_men']=="Yes")? 1 : Null ;				
						$PropertyDetail->property_title = ($value['property_title'])? $value['property_title'] : Null;
						$PropertyDetail->property_about = ($value['property_about'])? $value['property_about']:Null;
						$PropertyDetail->total_room_for_rent  = ($value['total_room_for_rent'])? $value['total_room_for_rent'] : Null;
						$PropertyDetail->total_bed_for_rent = ($value['total_bed_for_rent'])? $value['total_bed_for_rent']:Null;
						$PropertyDetail->food_exclusive_rent = ($value['food_exclusive_rent'])? $value['food_exclusive_rent']:Null;
						$PropertyDetail->amenities_others_text = ($value['amenities_others_text'])? $value['amenities_others_text']:Null;
						$PropertyDetail->amenities_others = ($value['amenities_others_text']!="") ? 1 : 0; 
						//$PropertyDetail->save();
						
						
						$PropertyOwner = new PropertyOwner();
						$PropertyOwner->property_id = $propertyId;
						$owner = Owner::where('owner_name', '=', $value['owner_id'])->select('id')->first();
						if($owner)
						{
							$PropertyOwner->owner_id = $owner->id;
						}
						else
						{
							$owner = Owner::select('id')->first();
							$PropertyOwner->owner_id = $owner->id;
						}
						$PropertyOwner->property_owned = ($value['property_owned']=="Yes")? 1 : 2 ;
						$PropertyOwner->lease_unit = ($value['lease_unit']=="Month")? 1 : 2 ;
						$PropertyOwner->lease_duration = ($value['lease_duration'])? $value['lease_duration']:Null;
						$PropertyOwner->lease_expiry = ($value['lease_expiry'])? $value['lease_expiry']:Null;
						$PropertyOwner->lease_deed = ($value['lease_deed'])? $value['lease_deed']:Null;
						$PropertyOwner->id_proof_is_same_address = ($value['id_proof_is_same_address']=="Yes")? 1 : 2 ;
						$PropertyOwner->property_diff_address = ($value['property_diff_address']=="Electricity Bill")? 1 : 2 ;				
						$PropertyOwner->save();		
						
						$messages= "Properties successfully Uploaded.";	
						$code="success";
					}
				}
				else
				{
					$code="error";
					$error= "No Property Uploaded.";
				}				
			}
			catch (\Exception $e) {
			
			$code="error";		
			 $messages= $e->getMessage() ;
			
			}
			return redirect('admin/bulk_upload_property')->with($code, $messages);
		}
	 return view('admin.property.bulkupload',['messages'=>$messages,'warning'=>$warning]);
	}
	
	
	public function inventory_management(Request $request)
	{
		$properties=PropertyInventoryRequest::with('property')->with('property_owner')->get();
		//dd($properties);
		return view("admin.property.property_inventory_list",compact('properties'));

	}
	
	public function view_invent_request(Request $request,$id)
	{
		$properties=PropertyInventoryDescription::where([['inventory_id',$id]])->with('property')->with('property_owner')->get();
		//dd($properties);
		return view("admin.property.view_invent_request",compact('properties'));

	}
	public function change_inventory_status(Request $request)
	{
		$data=array('request_status'=>$request->request_status);
		$properties=PropertyInventoryDescription::where('id',$request->id)->update($data);
		if($properties)
		{
		//dd($properties);
		 return response()->json(['code'   => 200]);
		}
		else
		{
			return response()->json(['code'   => 201]);
		}

	}
	public function change_inventory_admin_status(Request $request)
	{
		$data=array('request_status'=>$request->request_status);
		$properties=PropertyInventoryRequest::where('id',$request->id)->update($data);
		if($properties)
		{
		//dd($properties);
		 return response()->json(['code'   => 200]);
		}
		else
		{
			return response()->json(['code'   => 201]);
		}

	}
	public function change_property_admin_status(Request $request)
	{
		$data=array('status'=>$request->status);
		$properties=PropertyRequestDetail::where('id',$request->id)->update($data);
		if($properties)
		{
		//dd($properties);
		 return response()->json(['code'   => 200]);
		}
		else
		{
			return response()->json(['code'   => 201]);
		}

	}
	public function property_lead_request(Request $request)
	{
		$properties=array();		
		$owner_name=$owner_number=$owner_id="";
		$property_type=$gender="";

		$address_city=$address_sector=$address_state="";
		$id=$request->id;
		
		$list    =  PropertyRequestDetail::where('request_status',0)->get();
		

		foreach($list as $key=>$value)
		{
			$property_type=$gender="";				
			$owner_name=$value->owner_name;
			$owner_number=$value->owner_number;
				
				$property_type=($value->property_type==1? "Flat" : ($value->property_type==2? 'PG': "Flat/PG"));
				if($value->property_available_women==1)
				{
					if($gender!="")
					{
						$gender.=", Women";
					}
					else{
						$gender.="Women";
					}
				}
				if($value->property_available_men==1)
				{
					if($gender!="")
					{
						$gender.=", Men";
					}
					else{
						$gender.="Men";
					}
				}
				if($value->property_available_unisex==1)
				{
					if($gender!="")
					{
						$gender.=", Unisex";
					}
					else{
						$gender.="Unisex";
					}
				}
				if($value->property_available_family==1)
				{

					if($gender!="")
					{
						$gender.=", Family";
					}
					else{
						$gender.="Family";
					}
				}
			
			
			if(isset($value->address_city))
			{
				$city=City::where([['id',$value->address_city]])->select('name')->first();
				$city=$city->name;
			}
			else
			{
				$city="";
			}
			
			$properties[]=array('gender'=>$gender,'property_type'=>$property_type,'request_status'=>$value->request_status,'status'=>$value->status,'id'=>$value->id,'owner_id'=>$owner_id,'owner_name'=>$owner_name,'owner_number'=>$owner_number,'city'=>$city);
		}

		//dd($properties);
		return view("admin.property.property_lead_request",compact('properties'));
	}
	public function property_add_request(Request $request)
	{
		$properties=array();		
		$owner_name=$owner_number=$owner_id="";
		$property_type=$gender="";

		$address_city=$address_sector=$address_state="";
		$id=$request->id;
		
		$list    =  PropertyRequestDetail::where('request_status',1)->get();
		

		foreach($list as $key=>$value)
		{
			$property_type=$gender="";				
			$owner_name=$value->owner_name;
			$owner_number=$value->owner_number;
				
				$property_type=($value->property_type==1? "Flat" : ($value->property_type==2? 'PG': "Flat/PG"));
				if($value->property_available_women==1)
				{
					if($gender!="")
					{
						$gender.=", Women";
					}
					else{
						$gender.="Women";
					}
				}
				if($value->property_available_men==1)
				{
					if($gender!="")
					{
						$gender.=", Men";
					}
					else{
						$gender.="Men";
					}
				}
				if($value->property_available_unisex==1)
				{
					if($gender!="")
					{
						$gender.=", Unisex";
					}
					else{
						$gender.="Unisex";
					}
				}
				if($value->property_available_family==1)
				{

					if($gender!="")
					{
						$gender.=", Family";
					}
					else{
						$gender.="Family";
					}
				}
			
			
			if(isset($value->address_city))
			{
				$city=City::where([['id',$value->address_city]])->select('name')->first();
				$city=$city->name;
			}
			else
			{
				$city="";
			}
			
			$properties[]=array('gender'=>$gender,'property_type'=>$property_type,'request_status'=>$value->request_status,'status'=>$value->status,'id'=>$value->id,'owner_id'=>$owner_id,'owner_name'=>$owner_name,'owner_number'=>$owner_number,'city'=>$city);
		}

		//dd($properties);
		return view("admin.property.property_add_request",compact('properties'));
	}
	public function property_request_detail(Request $request,$id)
	{
		
		$amenities=array();
        $propertyData = PropertyRequestDetail::with(['property_request_amenities'=>function($query){ $query->select('property_id','amenities_id');}])    
	   ->with(['property_request_descriptions'=> function($query){ $query->select('room_type','description','rent','property_id','quantity','security');}])	   
	   ->where('id',$id)
        ->get()->first();
		
		if(isset($propertyData->property_request_amenities))
		{
			foreach($propertyData->property_request_amenities as $key=>$value)
			{
				$property_amenities=Amenties::where([['id',$value->amenities_id]])->first();
				$amenities[]=array('name'=>$property_amenities->name,'image'=>$property_amenities->image);
			}
		}


        if(!empty($propertyData)){
            return view("admin.property.property_request_detail",compact('propertyData','amenities'));
        }else{
            return back()->with('No record found');
        }
	}
	function delete_request(Request $request,$id)
    {
        if (PropertyRequestDetail::where('id',$id)->exists()) {
			PropertyRequestDetail::where('id',$id)->delete();
			PropertyRequestDescription::where('property_id',$id)->delete();	
			PropertyRequestAmenities::where('property_id',$id)->delete();				
			return response()->json(['status' => 'success']);
		}
		else {
		  return response()->json(['status' => 'failure']);
		}
    }
}

