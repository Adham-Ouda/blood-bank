<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model 
{

    protected $table = 'cities';
    public $timestamps = true;
    protected $fillable = array('city','governorate_id');

    public function governorate()
    {
        return $this->belongsTo('App\Governorate');
    }

    /*public function client()
    {
        return $this->belongsToMany('App\Client');
    }*/

    public function client()
    {
        return $this->hasMany('App\Client');
    }

    public function cityclient()
    {
        return $this->hasMany('App\CityClient');
    }

    public function donationsOrder()
    {
        return $this->hasMany('App\DonationOrders');
    }

}