<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SocialIdentities extends Model
{
    protected $fillable = ['user_id', 'provider_name', 'provider_id'];

    public function user() {
        return $this->belongsTo('App\User');
    }
}
