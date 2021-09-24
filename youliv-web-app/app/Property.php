<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    //

    protected $table = 'property';
    protected $fillable = [
        'property_id',
        'property_name',
        'address',
        'lat',
        'lng',
        'Sector',
        'country',
        'state',
        'city',
        'pincode',
        'landmark',
    ];
	public function property_descriptions() {
        return $this->hasMany('App\PropertyDescription','property_id','id');
    }
	public function property_images() {
        return $this->hasMany('App\PropertyImages','property_id','id');
    }
	public function property_addresses() {
        return $this->hasOne('App\PropertyAddress','property_id','id');
    }
	public function property_details() {
        return $this->hasOne('App\PropertyDetail','property_id','id');
    }
	public function property_amenities() {
        return $this->hasMany('App\PropertyAmenities','property_id','id');
    }
	public function property_owners() {
        return $this->hasOne('App\PropertyOwner','property_id','id');
    }
	public function property_additional_information() {
        return $this->hasMany('App\PropertyAdditionalInformation','property_id','id');
    }
	public function property_digital_signature() {
        return $this->hasOne('App\PropertyDigitalSignature','property_id','id');
    }
	public function property_neighbourhood() {
        return $this->hasMany('App\PropertyNeighbourhood','property_id','id');
    }
}
