<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    protected $fillable = ['title', 'desription', 'room', 'bath', 'square_meters', 'latitude', 'longitude', 'image_url', 'status'];

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function messages() {
        return $this->hasMany('App\Message');
    }

    public function sponsors() {
        return $this->belongsToMany('App\Sponsor');
    }

    public function services() {
        return $this->belongsToMany('App\Service');
    }
}
