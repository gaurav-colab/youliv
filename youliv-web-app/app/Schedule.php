<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Schedule extends Authenticatable 
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
	 
	   protected $fillable = [
	      'user_id','property_id', 'date','time', 'status','visit_time','area_manager_id'
		  ];
		  
    public function property_details() {
        return $this->hasOne('App\PropertyDetail','property_id','property_id');
    }
   public function property_address() {
        return $this->hasOne('App\PropertyAddress','property_id','property_id');
    }
	
	public function property_images() {
        return $this->hasOne('App\PropertyImages','property_id','property_id');
    }
	public function property() {
        return $this->hasOne('App\Property','id','property_id');
    }
	
	public function user() {
        return $this->hasOne('App\User','id','user_id');
    }
}
