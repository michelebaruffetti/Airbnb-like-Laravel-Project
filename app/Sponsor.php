<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sponsor extends Model
{
    public function apartments() {
        return $this->belongToMany('App\Apartment');
    }
}
