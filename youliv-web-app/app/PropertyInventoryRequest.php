<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PropertyInventoryRequest extends Model
{
    //
	public function property() {
        return $this->belongsTo('App\Property','property_id','id');
    }
	public function property_owner() {
        return $this->hasOne('App\PropertyOwner','property_id','property_id');
    }
}
