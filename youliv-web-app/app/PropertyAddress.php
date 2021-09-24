<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PropertyAddress extends Model
{
    public function city() {
        return $this->belongsTo('App\Cities','address_city');
    }
}
