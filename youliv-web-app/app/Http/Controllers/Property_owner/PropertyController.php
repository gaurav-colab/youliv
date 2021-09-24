<?php

namespace App\Http\Controllers\Property_owner;

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
use App\PropertyOwnerBankDetails;
use App\PropertyDetail;
use App\PropertyDescription;
use App\PropertyInventoryRequest;
use App\PropertyInventoryDescription;
use App\PropertyAdditionalInformation;
use App\PropertyImages;
use App\PropertyAmenities;
use App\PropertyAddress;
use DataTables;
use Auth;
use Illuminate\Validation\Rule;
use Session;

class PropertyController extends Controller
{
    /**
     * Only Authenticated users for "Property Owner" guard
     * are allowed.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:property_owner');
    }
    public function property_list()
    {
		$owner_id=Auth::user()->id;
		$properties=array();
       	$list = Property::with(['property_descriptions'=> function($query){ $query->select('room_type','description','rent','property_id');}])
		->with(['property_addresses'=> function($query){ $query->select('address_house','address_building','zipcode','address_sector','address_city','address_state','property_id');}])
		->with(['property_details'=> function($query){ $query->select('property_available_women','property_available_men','property_available_unisex','property_available_family','property_type','featured','property_id')->orderBy('featured');}])
		->with(['property_owners'=> function($query) { $query->select('owner_id','property_id');}])->whereHas('property_owners', function($q) use($owner_id) { $q->where('owner_id','=', $owner_id);})->orderBy('property.id', 'desc')->get();
      
		foreach($list as $key=>$value)
		{
			$property_type=$gender="";
			if(isset($value->property_owners->owner_id))
			{
				$owner=Owner::where([['id',$value->property_owners->owner_id]])->select('owner_name','owner_number','property_owner_id_drop','property_owner_id_front','property_owner_id_back')->first();
				if($owner->property_owner_id_drop!="" && $owner->property_owner_id_front!="" && $owner->property_owner_id_back!="")
				{
					$verified="Verified";
				}
				$owner_id=$value->property_owners->owner_id;
				$owner_name=$owner->owner_name;
				$owner_number=$owner->owner_number;
			}
			if(isset($value->property_details->featured))
			{				
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
			if(isset($value->property_addresses->address_sector))
			{
				$sector=Sector::where([['id',$value->property_addresses->address_sector]])->select('name')->first();
				$sector=$sector->name;
			}
			else
			{
				$sector="";
			}
			if(isset($value->property_addresses->address_state))
			{
				$state=State::where([['id',$value->property_addresses->address_state]])->select('name')->first();
				$state=$state->name;
			}
			else
			{
				$state="";
			}
			$properties[]=array('property'=>$value,'gender'=>$gender,'property_type'=>$property_type,'id'=>$value->id,'owner'=>$owner,'area_manager_id'=>$value->area_manager_id,'property_code'=>$value->property_code,'owner_name'=>$owner_name,'owner_number'=>$owner_number,'area_manager'=>$area_manager->name,'area_manager_phone'=>$area_manager->phone,'city'=>$city,'sector'=>$sector,'state'=>$state);
		}
	
	   return view("property_owner.property.property_list",compact('properties'));
    }

    public function payment_detail()
    {
		$owner_pay=PropertyOwnerBankDetails::where('owner_id',Auth::guard('property_owner')->user()->id)->first();
        return view("property_owner.property.payment_detail",compact('owner_pay'));
    }


    private function validator(Request $request)
    {

        $rules = [
            'select_payment' => 'required',
            'name_match' => 'required_if:select_payment,1',
            'upiNameMatch' => 'required_if:select_payment,2',
            'account_holder_name' => 'required_if:select_payment,1',
            'mobile_number' => 'required_if:select_payment,1',
            'account_number' => 'required_if:select_payment,1',
            'c_account_number' => ['required_if:select_payment,1','same:account_number'],
            'ifsc' => 'required_if:select_payment,1',
            'bank_name' => 'required_if:select_payment,1',
            'authority_file' => 'required_if:name_match,0',

            //'upi_authority_file' => Rule::requiredIf('select_payment == 2' && 'upiNameMatch==0'),
            'upi_authority_file' => 'required_if:upiNameMatch,0',
            'upi_holder_name' => 'required_if:select_payment,2',
            'upi_mobile_number' => 'required_if:select_payment,2',
            'upi_id_owner' => 'required_if:select_payment,2',

        ];
        $messages = [
            'account_holder_name.required_if' => 'Account holder name is required',
            'mobile_number.required_if' => 'Mobile Number is required',
            'account_number.required_if' => 'Account number is required',
            'c_account_number.required_if' => "Confirme account number did'nt match",
            'ifsc.required_if' => 'Bank IFSC Code is required',
            'bank_name.required_if' => 'Bank name is required',
            'authority_file.required_if'    =>  'Please attached the authorized file required',

            'upi_holder_name.required_if' => 'UPI account holder name is required',
            'upi_mobile_number.required_if' => 'UPI mobile number is required',
            'upi_id_owner.required_if' => 'UPI Id is required',
            'upi_authority_file.required_if'    =>  'Please attached the authorized file required',

        ];

        $request->validate($rules,$messages);
    }



    public function savePropertyOwnerBankDetails(Request $request)

    {

        /* echo "<pre>";
        print_r($request->all());
        die; */

        

        $userId = Auth::guard('property_owner')->user()->id;
        if($userId){
            //$this->validator($request);
					
					$propertyOwner=array();
					$holderName = ($request->account_holder_name)?$request->account_holder_name:Null;
                    $phoneNumber = ($request->mobile_number)?$request->mobile_number:Null;
					
					//$propertyOwner   =   new PropertyOwnerBankDetails();
                    $propertyOwner['owner_id']       =   $userId ;
					$propertyOwner['name']           =   $holderName;
                    $propertyOwner['mobile_number']   =  $phoneNumber;
					$propertyOwner['payment_type']    =  ($request->select_payment)?$request->select_payment:1 ;
					
					
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
                    $owner_pay=PropertyOwnerBankDetails::where('owner_id',$userId)->first();
					if($owner_pay)
					{
						
						if($authorityFileImage!=Null || $request->payment_type!=$owner_pay->select_payment || $request->account_number!=$owner_pay->account_number || $request->ifsc!=$owner_pay->ifsc || $request->bank_name!=$owner_pay->bank_name|| $request->mobile_number!=$owner_pay->mobile_number || $request->account_holder_name!=$owner_pay->name || $request->upi_id_owner!=$owner_pay->upi_id )
						{
							$propertyOwner['approved']       = 0;
							$owner=PropertyOwnerBankDetails::where('owner_id',$userId)->update($propertyOwner);
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
                    return redirect('/property_owner/payment_detail');
        }else{

            return redirect('/property_owner/login');
        }




    }

    public function property_list_data()
    {
        $user = Auth::guard('property_owner')->user();


        $properties = Property::join('property_owners', 'property_owners.property_id', '=', 'property.id')->where('property_owners.owner_id', '=', $user->id)->orderBy('property.id', 'desc')->select('property.*')->get()->toArray();

        $data = [];
        foreach ($properties as $property) {

            $property_address = PropertyAddress::where('property_id', '=', $property['id'])->get()->first();

            $property['complete_address'] = "";
            if (!empty($property_address)) {
                $property['complete_address'] = $property_address['address_house'] . ',' . $property_address['address_building'] . ',' . $property_address['address_street'];
            }

            $property_owner = PropertyOwner::select('owners.owner_name')->join('owners', 'owners.id', '=', 'property_owners.owner_id')->where('property_id', '=', $property['id'])->get()->first();

            $property['owner_name'] = "";
            if (!empty($property_owner)) {
                $property['owner_name'] = $property_owner['owner_name'];
            }

            $property_manager = AreaManager::where('id', '=', $property['area_manager_id'])->get()->first();

            $property['area_manager'] = "";
            if (!empty($property_owner)) {
                $property['area_manager'] = $property_manager['name'];
            }

            $data[] = $property;
        }

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                // $btn = '<a href="property_detail/' . $row['id'] . '" class="edit btn btn-primary-custom btn-sm">Manage</a>';
                $btn = '<a href="property_detail/' . base64_encode($row['id']) . '" class="edit btn btn-primary-custom btn-sm">Manage</a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function property_detail($id)
    {
       // $id =   base64_decode($id);
//Inventory & Price management
		if($id!="")
		{
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
			if(!empty($propertyData)){
				//dd($propertyData);
				//dd($propertyData );
				$verified="Non Verified";
				 $property_manager = AreaManager::where('id',$propertyData->area_manager_id)->first();
				 if(isset($propertyData->property_owners->owner_id))
					{
						$property_owner=Owner::where([['id',$propertyData->property_owners->owner_id]])->select('owner_email','alernate_number','owner_name','owner_number','property_owner_id_drop','property_owner_id_front','property_owner_id_back','property_gst')->first();
						if($property_owner->property_owner_id_drop!="" && $property_owner->property_owner_id_front!="" && $property_owner->property_owner_id_back!="")
						{
							$verified="Verified";
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

				/* echo "<pre>";
				print_r($propertyData);
				die; */
			
				return view("property_owner.property.property_detail",compact('property_gst','propertyData','amenities','property_manager','property_owner','verified','property_owner_id_drop','property_owner_id_front','property_owner_id_back'));
			}else{
				return back()->with('No record found');
			}
			
		}
		else{
				return back()->with('No record found');
			}
    }
	public function inventory_management(Request $request)
	{
		//$propertyData=PropertyInventoryDescription::get();
		//return view("property_owner.property.property_inventory_list",compact('propertyData');

	}
	public function add_empty($property_id,$room_type,$inventory_id)
	{
		$PropertyInventoryDescription = new PropertyInventoryDescription();
		$PropertyInventoryDescription->property_id     = $property_id;
		$PropertyInventoryDescription->room_type   = $room_type;
		$PropertyInventoryDescription->quantity_to      = Null;
		$PropertyInventoryDescription->rent_to        = Null;;
		$PropertyInventoryDescription->security_to  = Null;
		$PropertyInventoryDescription->description_to = Null;
		
		$PropertyInventoryDescription->quantity_from      = Null;
		$PropertyInventoryDescription->rent_from        = Null;
		$PropertyInventoryDescription->security_from  = Null;
		$PropertyInventoryDescription->description_from = Null;
		$PropertyInventoryDescription->status = 1;
		$PropertyInventoryDescription->inventory_id = $inventory_id;
		$Property_description_id = $PropertyInventoryDescription->save();
	}
 public function edit_inventory(Request $request,$property_id)
    {
		if($request->isMethod('post'))
		{ //dd($request);
			
			$property_id=$request->property_id;
			
			$data = new PropertyInventoryRequest();
			$data->request_date = date('Y-m-d');
			$data->property_id     = $property_id;
			$data->save();
			$inventory_id=$data->id;
			
			if(isset($request->room_type))
			{
				
				//PropertyInventoryDescription::where('property_id',$property_id)->delete();
				
				$PropertyInventoryDescription = new PropertyInventoryDescription();

				if (in_array("single_sharing", $request->room_type)) {
					
					$detail=PropertyDescription::where([['property_id',$request->property_id],['room_type',1]])->first();
						if($detail)
						{
							if($request->single_sharing_quantity=="" && $request->single_sharing_rent=="" && $request->single_sharing_security=="" && $request->single_sharing_description=="")
							{		
								$this->add_empty($property_id,1,$inventory_id);
							}
							elseif($request->single_sharing_quantity!=$detail->quantity || $request->single_sharing_rent!=$detail->rent || $request->single_sharing_security!=$detail->security || $request->single_sharing_description!=$detail->description)
							{	
								$PropertyInventoryDescription = new PropertyInventoryDescription();
								$PropertyInventoryDescription->property_id     = $property_id;
								$PropertyInventoryDescription->room_type     = 1;
								$PropertyInventoryDescription->quantity_to      = $request->single_sharing_quantity;
								$PropertyInventoryDescription->rent_to        = $request->single_sharing_rent;
								$PropertyInventoryDescription->security_to  = $request->single_sharing_security;
								$PropertyInventoryDescription->description_to = $request->single_sharing_description;
								$PropertyInventoryDescription->inventory_id = $inventory_id;
								$PropertyInventoryDescription->quantity_from      = $detail->quantity;
								$PropertyInventoryDescription->rent_from        = $detail->rent;
								$PropertyInventoryDescription->security_from  = $detail->security;
								$PropertyInventoryDescription->description_from = $detail->description;
								$PropertyInventoryDescription->status = 0;
								$Property_description_id = $PropertyInventoryDescription->save();
							}
							else
							{
								
							}						
						}
						else
						{
							if($request->single_sharing_quantity!="" || $request->single_sharing_rent!="" || $request->single_sharing_security!="" || $request->single_sharing_description!="" )
							{
								$PropertyInventoryDescription = new PropertyInventoryDescription();
								$PropertyInventoryDescription->property_id     = $property_id;
								$PropertyInventoryDescription->room_type     = 1;
								$PropertyInventoryDescription->quantity_to      = $request->single_sharing_quantity;
								$PropertyInventoryDescription->rent_to        = $request->single_sharing_rent;
								$PropertyInventoryDescription->security_to  = $request->single_sharing_security;
								$PropertyInventoryDescription->description_to = $request->single_sharing_description;
								$PropertyInventoryDescription->status = 0;
								$PropertyInventoryDescription->inventory_id = $inventory_id;
								$Property_description_id = $PropertyInventoryDescription->save();
							}
						}
				}

				if (in_array("twin_sharing", $request->room_type))  {					
					
					$detail=PropertyDescription::where([['property_id',$property_id],['room_type',2]])->first();
						if($detail)
						{
							if($request->twin_sharing_quantity=="" && $request->twin_sharing_rent=="" && $request->twin_sharing_security=="" && $request->twin_sharing_description=="")
							{	
								$this->add_empty($property_id,2,$inventory_id);
							}
							elseif($request->twin_sharing_quantity!=$detail->quantity || $request->twin_sharing_rent!=$detail->rent || $request->twin_sharing_security!=$detail->security || $request->twin_sharing_description!=$detail->description)
							{		
								$PropertyInventoryDescription = new PropertyInventoryDescription();
								$PropertyInventoryDescription->property_id     = $property_id;
								$PropertyInventoryDescription->room_type     = 2;
								$PropertyInventoryDescription->quantity_to = $request->twin_sharing_quantity;
								$PropertyInventoryDescription->rent_to = $request->twin_sharing_rent;
								$PropertyInventoryDescription->security_to = $request->twin_sharing_security;
								$PropertyInventoryDescription->description_to = $request->twin_sharing_description;
								$PropertyInventoryDescription->inventory_id = $inventory_id;
								$PropertyInventoryDescription->quantity_from      = $detail->quantity;
								$PropertyInventoryDescription->rent_from        = $detail->rent;
								$PropertyInventoryDescription->security_from  = $detail->security;
								$PropertyInventoryDescription->description_from = $detail->description;
								$PropertyInventoryDescription->status = 0;
								$Property_description_id = $PropertyInventoryDescription->save();
							}
						}
						else
						{
							if($request->twin_sharing_quantity!="" || $request->twin_sharing_rent!="" || $request->twin_sharing_security!="" || $request->twin_sharing_description!="")
							{
								$PropertyInventoryDescription = new PropertyInventoryDescription();
								$PropertyInventoryDescription->property_id     = $property_id;
								$PropertyInventoryDescription->room_type     = 2;
								$PropertyInventoryDescription->quantity_to = $request->twin_sharing_quantity;
								$PropertyInventoryDescription->rent_to = $request->twin_sharing_rent;
								$PropertyInventoryDescription->security_to = $request->twin_sharing_security;
								$PropertyInventoryDescription->description_to = $request->twin_sharing_description;
								$PropertyInventoryDescription->status = 2;
								$PropertyInventoryDescription->inventory_id = $inventory_id;
								$Property_description_id = $PropertyInventoryDescription->save();
							}
						}
				}

				if (in_array("triple_sharing", $request->room_type)) {
						
						$detail=PropertyDescription::where([['property_id',$property_id],['room_type',3]])->first();
						if($detail)
						{
							if($request->triple_sharing_quantity=="" && $request->triple_sharing_rent=="" && $request->triple_sharing_security=="" && $request->triple_sharing_description=="")
							{	
								$this->add_empty($property_id,3,$inventory_id);
							}
							else if($request->triple_sharing_quantity!=$detail->quantity || $request->triple_sharing_rent!=$detail->rent || $request->triple_sharing_security!=$detail->security || $request->triple_sharing_description!=$detail->description)
							{	
								$PropertyInventoryDescription = new PropertyInventoryDescription();
								$PropertyInventoryDescription->property_id     = $property_id;
								$PropertyInventoryDescription->room_type = 3;
								$PropertyInventoryDescription->quantity_to = $request->triple_sharing_quantity;
								$PropertyInventoryDescription->rent_to = $request->triple_sharing_rent;
								$PropertyInventoryDescription->security_to = $request->triple_sharing_security;
								$PropertyInventoryDescription->description_to = $request->triple_sharing_description;
								$PropertyInventoryDescription->inventory_id = $inventory_id;
								$PropertyInventoryDescription->quantity_from      = $detail->quantity;
								$PropertyInventoryDescription->rent_from        = $detail->rent;
								$PropertyInventoryDescription->security_from  = $detail->security;
								$PropertyInventoryDescription->description_from = $detail->description;
								$PropertyInventoryDescription->status = 0;

								$Property_description_id = $PropertyInventoryDescription->save();
							}
							else
							{
							}
						}
						else
						{
							if($request->triple_sharing_quantity!="" || $request->triple_sharing_rent!="" || $request->triple_sharing_security!="" || $request->triple_sharing_description!="")
							{
								$PropertyInventoryDescription = new PropertyInventoryDescription();
								$PropertyInventoryDescription->property_id     = $property_id;
								$PropertyInventoryDescription->room_type = 3;
								$PropertyInventoryDescription->quantity_to = $request->triple_sharing_quantity;
								$PropertyInventoryDescription->rent_to = $request->triple_sharing_rent;
								$PropertyInventoryDescription->security_to = $request->triple_sharing_security;
								$PropertyInventoryDescription->description_to = $request->triple_sharing_description;
								$PropertyInventoryDescription->status = 2;
								$PropertyInventoryDescription->inventory_id = $inventory_id;
								$Property_description_id = $PropertyInventoryDescription->save();
							}
						}
				}

				if (in_array("other", $request->room_type)) {
					
					$detail=PropertyDescription::where([['property_id',$property_id],['room_type',4]])->first();
						if($detail)
						{
							if($request->other_room_quantity=="" && $request->other_room_rent=="" && $request->other_room_security=="" && $request->other_room_description=="")
								{	
									$this->add_empty($property_id,4,$inventory_id);
								}
							elseif($request->other_room_quantity!=$detail->quantity || $request->other_room_rent!=$detail->rent || $request->other_room_security!=$detail->security || $request->other_room_description!=$detail->description)
							{
								$PropertyInventoryDescription = new PropertyInventoryDescription();
								$PropertyInventoryDescription->property_id     = $property_id;
								$PropertyInventoryDescription->room_type = 4;
								$PropertyInventoryDescription->quantity_to = $request->other_room_quantity;
								$PropertyInventoryDescription->rent_to = $request->other_room_rent;
								$PropertyInventoryDescription->security_to = $request->other_room_security;
								$PropertyInventoryDescription->description_to = $request->other_room_description;
								$PropertyInventoryDescription->inventory_id = $inventory_id;
								$PropertyInventoryDescription->quantity_from      = $detail->quantity;
								$PropertyInventoryDescription->rent_from        = $detail->rent;
								$PropertyInventoryDescription->security_from  = $detail->security;
								$PropertyInventoryDescription->description_from = $detail->description;
								$PropertyInventoryDescription->status = 0;

								$Property_description_id = $PropertyInventoryDescription->save();
							}
							else
							{
							}
						}
						else
						{
							if($request->other_room_quantity!="" || $request->other_room_rent!="" || $request->other_room_security!="" || $request->other_room_description!="" )
							{	
								$PropertyInventoryDescription = new PropertyInventoryDescription();
								$PropertyInventoryDescription->property_id     = $property_id;
								$PropertyInventoryDescription->room_type = 4;
								$PropertyInventoryDescription->quantity_to = $request->other_room_quantity;
								$PropertyInventoryDescription->rent_to = $request->other_room_rent;
								$PropertyInventoryDescription->security_to = $request->other_room_security;
								$PropertyInventoryDescription->description_to = $request->other_room_description;
								$PropertyInventoryDescription->status = 2;
								$PropertyInventoryDescription->inventory_id = $inventory_id;
								$Property_description_id = $PropertyInventoryDescription->save();
							}
						}
					}
							

				if (in_array("one_room", $request->room_type)) {
						$property_id=$request->property_id;
						$detail=PropertyDescription::where([['property_id',$property_id],['room_type',9]])->first();
						if($detail)
						{
							if($request->one_room_quantity=="" && $request->one_room_rent=="" && $request->one_room_security=="" && $request->one_room_description=="")
							{	
								$this->add_empty($property_id,9,$inventory_id);
							}
							if($request->one_room_quantity!=$detail->quantity || $request->one_room_rent!=$detail->rent || $request->one_room_security!=$detail->security || $request->one_room_description!=$detail->description)
							{	
								$PropertyInventoryDescription = new PropertyInventoryDescription();
								$PropertyInventoryDescription->property_id     = $property_id;
								$PropertyInventoryDescription->room_type     = 9;
								$PropertyInventoryDescription->quantity_to = $request->one_room_quantity;
								$PropertyInventoryDescription->rent_to = $request->one_room_rent;
								$PropertyInventoryDescription->security_to = $request->one_room_security;
								$PropertyInventoryDescription->description_to = $request->one_room_description;
								$PropertyInventoryDescription->inventory_id = $inventory_id;
								$PropertyInventoryDescription->quantity_from      = $detail->quantity;
								$PropertyInventoryDescription->rent_from        = $detail->rent;
								$PropertyInventoryDescription->security_from  = $detail->security;
								$PropertyInventoryDescription->description_from = $detail->description;
								$PropertyInventoryDescription->status = 0;

								$Property_description_id = $PropertyInventoryDescription->save();
							}
							else
							{
							}
						}
						else
						{
							if($request->one_room_quantity!="" || $request->one_room_rent!="" || $request->one_room_security!="" || $request->one_room_description!="" )
							{
								$PropertyInventoryDescription = new PropertyInventoryDescription();
								$PropertyInventoryDescription->property_id     = $property_id;
								$PropertyInventoryDescription->room_type     = 9;
								$PropertyInventoryDescription->quantity_to = $request->one_room_quantity;
								$PropertyInventoryDescription->rent_to = $request->one_room_rent;
								$PropertyInventoryDescription->security_to = $request->one_room_security;
								$PropertyInventoryDescription->description_to = $request->one_room_description;
								$PropertyInventoryDescription->status = 2;
								$PropertyInventoryDescription->inventory_id = $inventory_id;
								$Property_description_id = $PropertyInventoryDescription->save();
							}
						}
				}
				if (in_array("two_room", $request->room_type)) {
					
					$detail=PropertyDescription::where([['property_id',$property_id],['room_type',10]])->first();
					if($detail)
					{
						if($request->two_room_quantity=="" && $request->two_room_rent=="" && $request->two_room_security=="" && $request->two_room_description=="")
						{	
							$this->add_empty($property_id,10,$inventory_id);
						}
						else if($request->two_room_quantity!=$detail->quantity || $request->two_room_rent!=$detail->rent || $request->two_room_security!=$detail->security || $request->two_room_description!=$detail->description)
						{	
							$PropertyInventoryDescription = new PropertyInventoryDescription();
							$PropertyInventoryDescription->property_id     = $property_id;
							$PropertyInventoryDescription->room_type     = 10;
							$PropertyInventoryDescription->quantity_to = $request->two_room_quantity;
							$PropertyInventoryDescription->rent_to = $request->two_room_rent;
							$PropertyInventoryDescription->security_to = $request->two_room_security;
							$PropertyInventoryDescription->description_to = $request->two_room_description;
							$PropertyInventoryDescription->inventory_id = $inventory_id;
							$PropertyInventoryDescription->quantity_from      = $detail->quantity;
							$PropertyInventoryDescription->rent_from        = $detail->rent;
							$PropertyInventoryDescription->security_from  = $detail->security;
							$PropertyInventoryDescription->description_from = $detail->description;
							$PropertyInventoryDescription->status = 0;

							$Property_description_id = $PropertyInventoryDescription->save();
						}
						else
						{
						}
					}
					else
					{
						if($request->two_room_quantity!="" || $request->two_room_rent!="" || $request->two_room_security!="" || $request->two_room_description!="" )
						{	
							$PropertyInventoryDescription = new PropertyInventoryDescription();
							$PropertyInventoryDescription->property_id     = $property_id;
							$PropertyInventoryDescription->room_type     = 10;
							$PropertyInventoryDescription->quantity_to = $request->two_room_quantity;
							$PropertyInventoryDescription->rent_to = $request->two_room_rent;
							$PropertyInventoryDescription->security_to = $request->two_room_security;
							$PropertyInventoryDescription->description_to = $request->two_room_description;
							$PropertyInventoryDescription->status = 2;
							$PropertyInventoryDescription->inventory_id = $inventory_id;
							$Property_description_id = $PropertyInventoryDescription->save();
						}
					}
				}
				if (in_array("three_room", $request->room_type)) {
					
						
						$detail=PropertyDescription::where([['property_id',$property_id],['room_type',13]])->first();
						if($detail)
						{
							if($request->three_room_quantity=="" && $request->three_room_rent=="" && $request->three_room_security=="" && $request->three_room_description=="")
							{	
								$this->add_empty($property_id,13,$inventory_id);
							}
							else if($request->three_room_quantity!=$detail->quantity || $request->three_room_rent!=$detail->rent || $request->three_room_security!=$detail->security || $request->three_room_description!=$detail->description)
							{	
								$PropertyInventoryDescription = new PropertyInventoryDescription();
								$PropertyInventoryDescription->property_id     = $property_id;
								$PropertyInventoryDescription->room_type     = 13;
								$PropertyInventoryDescription->quantity_to = $request->three_room_quantity;
								$PropertyInventoryDescription->rent_to = $request->three_room_rent;
								$PropertyInventoryDescription->security_to = $request->three_room_security;
								$PropertyInventoryDescription->description_to = $request->three_room_description;
								$PropertyInventoryDescription->inventory_id = $inventory_id;
								$PropertyInventoryDescription->quantity_from      = $detail->quantity;
								$PropertyInventoryDescription->rent_from        = $detail->rent;
								$PropertyInventoryDescription->security_from  = $detail->security;
								$PropertyInventoryDescription->description_from = $detail->description;
								$PropertyInventoryDescription->status = 0;
								$Property_description_id = $PropertyInventoryDescription->save();
							}
							else
							{
							}
						}
						else
						{
							if($request->three_room_quantity!="" || $request->three_room_rent!="" || $request->three_room_security!="" || $request->three_room_description!="")
							{
								$PropertyInventoryDescription = new PropertyInventoryDescription();
								$PropertyInventoryDescription->property_id     = $property_id;
								$PropertyInventoryDescription->room_type     = 13;
								$PropertyInventoryDescription->quantity_to = $request->three_room_quantity;
								$PropertyInventoryDescription->rent_to = $request->three_room_rent;
								$PropertyInventoryDescription->security_to = $request->three_room_security;
								$PropertyInventoryDescription->description_to = $request->three_room_description;
								$PropertyInventoryDescription->status = 2;
								$PropertyInventoryDescription->inventory_id = $inventory_id;
								$Property_description_id = $PropertyInventoryDescription->save();
							}
						}
				}

				if (in_array("one_rk", $request->room_type)) {
					
					$detail=PropertyDescription::where([['property_id',$property_id],['room_type',5]])->first();
					
						if($detail)
						{
							if($request->one_rk_quantity=="" && $request->one_rk_rent=="" && $request->one_rk_security=="" && $request->one_rk_description=="")
							{
								$this->add_empty($property_id,5,$inventory_id);	
							}
							else if($request->one_rk_quantity!=$detail->quantity || $request->one_rk_rent!=$detail->rent || $request->one_rk_security!=$detail->security || $request->one_rk_description!=$detail->description)
							{	
								$PropertyInventoryDescription = new PropertyInventoryDescription();
								$PropertyInventoryDescription->property_id     = $property_id;
								$PropertyInventoryDescription->room_type     = 5;
								$PropertyInventoryDescription->quantity_to = $request->one_rk_quantity;
								$PropertyInventoryDescription->rent_to = $request->one_rk_rent;
								$PropertyInventoryDescription->security_to = $request->one_rk_security;
								$PropertyInventoryDescription->description_to = $request->one_rk_description;
								$PropertyInventoryDescription->inventory_id = $inventory_id;
								$PropertyInventoryDescription->quantity_from      = $detail->quantity;
								$PropertyInventoryDescription->rent_from        = $detail->rent;
								$PropertyInventoryDescription->security_from  = $detail->security;
								$PropertyInventoryDescription->description_from = $detail->description;
								$PropertyInventoryDescription->status = 0;

								$Property_description_id = $PropertyInventoryDescription->save();
							}
							else
							{
							}
						}
						else
						{
							if($request->one_rk_quantity!="" || $request->one_rk_rent!="" || $request->one_rk_security!="" || $request->one_rk_description!="")
							{	
								$PropertyInventoryDescription = new PropertyInventoryDescription();
								$PropertyInventoryDescription->property_id     = $property_id;
								$PropertyInventoryDescription->room_type     = 5;
								$PropertyInventoryDescription->quantity_to = $request->one_rk_quantity;
								$PropertyInventoryDescription->rent_to = $request->one_rk_rent;
								$PropertyInventoryDescription->security_to = $request->one_rk_security;
								$PropertyInventoryDescription->description_to = $request->one_rk_description;
								$PropertyInventoryDescription->status = 2;
								$PropertyInventoryDescription->inventory_id = $inventory_id;
								$Property_description_id = $PropertyInventoryDescription->save();
							}
							
						}
				}


				if (in_array("one_bhk", $request->room_type)) {
				
					$detail=PropertyDescription::where([['property_id',$property_id],['room_type',6]])->first();
						if($detail)
						{
							if($request->one_bhk_quantity=="" && $request->one_bhk_rent=="" && $request->one_bhk_security=="" && $request->one_bhk_description=="")
							{	
								$this->add_empty($property_id,6,$inventory_id);
							}
							else if($request->one_bhk_quantity!=$detail->quantity || $request->one_bhk_rent!=$detail->rent || $request->one_bhk_security!=$detail->security || $request->one_bhk_description!=$detail->description)
							{	
								$PropertyInventoryDescription = new PropertyInventoryDescription();
								$PropertyInventoryDescription->property_id     = $property_id;
								$PropertyInventoryDescription->room_type     = 6;
								$PropertyInventoryDescription->quantity_to = $request->one_bhk_quantity;
								$PropertyInventoryDescription->rent_to = $request->one_bhk_rent;
								$PropertyInventoryDescription->security_to = $request->one_bhk_security;
								$PropertyInventoryDescription->description_to = $request->one_bhk_description;
								$PropertyInventoryDescription->inventory_id = $inventory_id;
								$PropertyInventoryDescription->quantity_from      = $detail->quantity;
								$PropertyInventoryDescription->rent_from        = $detail->rent;
								$PropertyInventoryDescription->security_from  = $detail->security;
								$PropertyInventoryDescription->description_from = $detail->description;
								$PropertyInventoryDescription->status = 0;

								$Property_description_id = $PropertyInventoryDescription->save();
							}
							else
							{
								
							}
						}
						else
						{
							if($request->one_bhk_quantity!="" || $request->one_bhk_rent!="" || $request->one_bhk_security!="" || $request->one_bhk_description!="")
							{	
								$PropertyInventoryDescription = new PropertyInventoryDescription();
								$PropertyInventoryDescription->property_id     = $property_id;
								$PropertyInventoryDescription->room_type     = 6;
								$PropertyInventoryDescription->quantity_to = $request->one_bhk_quantity;
								$PropertyInventoryDescription->rent_to = $request->one_bhk_rent;
								$PropertyInventoryDescription->security_to = $request->one_bhk_security;
								$PropertyInventoryDescription->description_to = $request->one_bhk_description;
								$PropertyInventoryDescription->status = 2;
								$PropertyInventoryDescription->inventory_id = $inventory_id;
								$Property_description_id = $PropertyInventoryDescription->save();
							}
						}
				}

				if (in_array("two_bhk", $request->room_type)) {					
					
						
						$detail=PropertyDescription::where([['property_id',$property_id],['room_type',7]])->first();
						if($detail)
						{
							if($request->two_bhk_quantity=="" && $request->two_bhk_rent=="" && $request->two_bhk_security=="" && $request->two_bhk_description=="")
							{	
								$this->add_empty($property_id,7,$inventory_id);
							}
							elseif($request->two_bhk_quantity!=$detail->quantity || $request->two_bhk_rent!=$detail->rent || $request->two_bhk_security!=$detail->security || $request->two_bhk_description!=$detail->description)
							{	
						
								$PropertyInventoryDescription = new PropertyInventoryDescription();
								$PropertyInventoryDescription->property_id     = $property_id;
								$PropertyInventoryDescription->room_type     = 7;
								$PropertyInventoryDescription->quantity_to = $request->two_bhk_quantity;
								$PropertyInventoryDescription->rent_to = $request->two_bhk_rent;
								$PropertyInventoryDescription->security_to = $request->two_bhk_security;
								$PropertyInventoryDescription->description_to = $request->two_bhk_description;
								$PropertyInventoryDescription->inventory_id = $inventory_id;
								$PropertyInventoryDescription->quantity_from      = $detail->quantity;
								$PropertyInventoryDescription->rent_from        = $detail->rent;
								$PropertyInventoryDescription->security_from  = $detail->security;
								$PropertyInventoryDescription->description_from = $detail->description;
								$PropertyInventoryDescription->status = 0;
								
								$Property_description_id = $PropertyInventoryDescription->save();
							}
							else
							{
								
							}
						}
						else
						{
							if($request->two_bhk_quantity!="" || $request->two_bhk_rent!="" || $request->two_bhk_security!="" && $request->two_bhk_description!="")
							{
								$PropertyInventoryDescription = new PropertyInventoryDescription();
								$PropertyInventoryDescription->property_id     = $property_id;
								$PropertyInventoryDescription->room_type     = 7;
								$PropertyInventoryDescription->quantity_to = $request->two_bhk_quantity;
								$PropertyInventoryDescription->rent_to = $request->two_bhk_rent;
								$PropertyInventoryDescription->security_to = $request->two_bhk_security;
								$PropertyInventoryDescription->description_to = $request->two_bhk_description;
								$PropertyInventoryDescription->inventory_id = $inventory_id;
								$Property_description_id = $PropertyInventoryDescription->save();
							}
						}
					}
				
				if (in_array("three_bhk", $request->room_type)) {
					
					$detail=PropertyDescription::where([['property_id',$property_id],['room_type',14]])->first();
						if($detail)
						{
							if($request->three_bhk_quantity=="" && $request->three_bhk_rent=="" && $request->three_bhk_security=="" && $request->three_bhk_description=="")
							{	
								$this->add_empty($property_id,14,$inventory_id);
							}
							elseif($request->three_bhk_quantity!=$detail->quantity || $request->three_bhk_rent!=$detail->rent || $request->three_bhk_security!=$detail->security || $request->three_bhk_description!=$detail->description)
							{	
						
								$PropertyInventoryDescription = new PropertyInventoryDescription();
								$PropertyInventoryDescription->property_id     = $property_id;
								$PropertyInventoryDescription->room_type     = 14;
								$PropertyInventoryDescription->quantity_to = $request->three_bhk_quantity;
								$PropertyInventoryDescription->rent_to = $request->three_bhk_rent;
								$PropertyInventoryDescription->security_to = $request->three_bhk_security;
								$PropertyInventoryDescription->description_to = $request->three_bhk_description;
								$PropertyInventoryDescription->inventory_id = $inventory_id;
								$PropertyInventoryDescription->quantity_from      = $detail->quantity;
								$PropertyInventoryDescription->rent_from        = $detail->rent;
								$PropertyInventoryDescription->security_from  = $detail->security;
								$PropertyInventoryDescription->description_from = $detail->description;
								$PropertyInventoryDescription->status = 0;

								$Property_description_id = $PropertyInventoryDescription->save();
							}
							else
							{
							}
						}
						else
						{
							if($request->three_bhk_quantity!="" || $request->three_bhk_rent!="" || $request->three_bhk_security!="" || $request->three_bhk_description!="")
							{
								$PropertyInventoryDescription = new PropertyInventoryDescription();
								$PropertyInventoryDescription->property_id     = $property_id;
								$PropertyInventoryDescription->room_type     = 14;
								$PropertyInventoryDescription->quantity_to = $request->three_bhk_quantity;
								$PropertyInventoryDescription->rent_to = $request->three_bhk_rent;
								$PropertyInventoryDescription->security_to = $request->three_bhk_security;
								$PropertyInventoryDescription->description_to = $request->three_bhk_description;
								$PropertyInventoryDescription->inventory_id = $inventory_id;
								$PropertyInventoryDescription->status = 2;

								$Property_description_id = $PropertyInventoryDescription->save();
							}
						}
				}
				if (in_array("four_bhk", $request->room_type)) {
				
					$detail=PropertyDescription::where([['property_id',$property_id],['room_type',15]])->first();
					if($detail)
					{
						if($request->four_bhk_quantity=="" && $request->four_bhk_sharing_rent=="" && $request->four_bhk_sharing_security=="" && $request->four_bhk_description=="")
						{	
							$this->add_empty($property_id,15,$inventory_id);
						}
						else if($request->four_bhk_quantity!=$detail->quantity || $request->four_bhk_rent!=$detail->rent || $request->four_bhk_security!=$detail->security || $request->four_bhk_description!=$detail->description)
						{	
							$PropertyInventoryDescription = new PropertyInventoryDescription();
							$PropertyInventoryDescription->property_id     = $property_id;
							$PropertyInventoryDescription->room_type     = 15;
							$PropertyInventoryDescription->quantity_to = $request->four_bhk_quantity;
							$PropertyInventoryDescription->rent_to = $request->four_bhk_rent;
							$PropertyInventoryDescription->security_to = $request->four_bhk_security;
							$PropertyInventoryDescription->description_to = $request->four_bhk_description;
							$PropertyInventoryDescription->inventory_id = $inventory_id;
							$PropertyInventoryDescription->quantity_from      = $detail->quantity;
							$PropertyInventoryDescription->rent_from        = $detail->rent;
							$PropertyInventoryDescription->security_from  = $detail->security;
							$PropertyInventoryDescription->description_from = $detail->description;
							$PropertyInventoryDescription->status = 0;

							$Property_description_id = $PropertyInventoryDescription->save();
						}
						else
						{
						}
					}
					else
					{
						if($request->four_bhk_quantity!="" || $request->four_bhk_sharing_rent!="" || $request->four_bhk_sharing_security!="" || $request->four_bhk_description!="")
						{	
							$PropertyInventoryDescription = new PropertyInventoryDescription();
							$PropertyInventoryDescription->property_id     = $property_id;
							$PropertyInventoryDescription->room_type     = 15;
							$PropertyInventoryDescription->quantity_to = $request->four_bhk_quantity;
							$PropertyInventoryDescription->rent_to = $request->four_bhk_rent;
							$PropertyInventoryDescription->security_to = $request->four_bhk_security;
							$PropertyInventoryDescription->description_to = $request->four_bhk_description;
							$PropertyInventoryDescription->inventory_id = $inventory_id;
							$PropertyInventoryDescription->status = 2;

							$Property_description_id = $PropertyInventoryDescription->save();
						}
					}
				}
				if (in_array("flat_other", $request->room_type)) {
					
					
				    $detail=PropertyDescription::where([['property_id',$property_id],['room_type',8]])->first();
					if($detail)
					{	
						if($request->other_flat_quantity=="" && $request->other_flat_rent=="" && $request->other_flat_security=="" && $request->other_flat_description=="")
						{	
							$this->add_empty($property_id,8,$inventory_id);
						}
						else if($request->other_flat_quantity!=$detail->quantity || $request->other_flat_rent!=$detail->rent || $request->other_flat_security!=$detail->security || $request->other_flat_description!=$detail->description)
							{	
								$PropertyInventoryDescription = new PropertyInventoryDescription();
								$PropertyInventoryDescription->property_id     = $property_id;
								$PropertyInventoryDescription->room_type    = 8;
								$PropertyInventoryDescription->quantity_to  = $request->other_flat_quantity;
								$PropertyInventoryDescription->rent_to  = $request->other_flat_rent;
								$PropertyInventoryDescription->security_to  = $request->other_flat_security;
								$PropertyInventoryDescription->description_to  = $request->other_flat_description;
								$PropertyInventoryDescription->inventory_id = $inventory_id;
								$PropertyInventoryDescription->quantity_from      = $detail->quantity;
								$PropertyInventoryDescription->rent_from        = $detail->rent;
								$PropertyInventoryDescription->security_from  = $detail->security;
								$PropertyInventoryDescription->description_from = $detail->description;
								$PropertyInventoryDescription->status = 0;

								$Property_description_id = $PropertyInventoryDescription->save();
							}
						else
						{
						}
											
					}
					else{
						
						if($request->other_flat_quantity!="" || $request->other_flat_rent!="" || $request->other_flat_security!="" || $request->other_flat_description!="")
							
							{
								$PropertyInventoryDescription = new PropertyInventoryDescription();
									$PropertyInventoryDescription->property_id     = $property_id;
									$PropertyInventoryDescription->room_type    = 8;
									$PropertyInventoryDescription->quantity_to  = $request->other_flat_quantity;
									$PropertyInventoryDescription->rent_to  = $request->other_flat_rent;
									$PropertyInventoryDescription->security_to  = $request->other_flat_security;
									$PropertyInventoryDescription->description_to  = $request->other_flat_description;
									$PropertyInventoryDescription->inventory_id = $inventory_id;
									$PropertyInventoryDescription->status =2;
									$Property_description_id = $PropertyInventoryDescription->save();
							}
						
					}
				}
				
		}
		Session::flash('message', 'Your request to Add/Edit/Delete Property detail succussfully submitted!'); 
	}	
        $propertyData = Property::select('property.*')->with('property_details')->with(['property_descriptions'=> function($query){ $query->select('room_type','description','rent','property_id','quantity');}])	  
	   ->where('property_code',$property_id)
        ->get()->first();
		

		$property_descript_list=array();		
		if(isset($propertyData->property_descriptions))
		{
			foreach($propertyData->property_descriptions as $key=>$value)
			{
				array_push($property_descript_list,$value->room_type);
			}
		}
		
        if(!empty($propertyData)){
            return view("property_owner.property.edit_inventory",compact('propertyData','property_descript_list'));
        }else{
            return back()->with('No record found');
        }
}

}
