<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PropertyRequestDetail extends Model
{
    public function property_request_descriptions() {
        return $this->hasMany('App\PropertyRequestDescription','property_id','id');
    }
	public function property_request_amenities() {
        return $this->hasMany('App\PropertyRequestAmenities','property_id','id');
    }
}
