<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CityClient extends Model 
{

    protected $table = 'city_client';
    public $timestamps = true;
    protected $fillable = array('client_id', 'city_id');

    public function client()
    {
        return $this->belongsTo('App\Client');
    }

    public function city()
    {
        return $this->belongsTo('App\City');
    }

}