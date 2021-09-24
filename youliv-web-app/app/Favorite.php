<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Favorite extends Authenticatable 
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'property_id','user_id'];
		
	public function property() {
        return $this->belongsTo('App\Property','property_id','id');
    }
	 public function property_details() {
        return $this->hasOne('App\PropertyDetail','property_id','property_id');
    }
   public function property_address() {
        return $this->hasOne('App\PropertyAddress','property_id','property_id');
    }
	
	public function property_images() {
        return $this->hasOne('App\PropertyImages','property_id','property_id');
    }
	
}
