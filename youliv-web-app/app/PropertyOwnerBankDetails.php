<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PropertyOwnerBankDetails extends Model
{
    protected $table = 'owner_bank_details';
	public function owner() {
        return $this->hasOne('App\Owner','id','owner_id');
    }
}
