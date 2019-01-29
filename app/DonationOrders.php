<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DonationOrders extends Model 
{

    protected $table = 'donation_orders';
    public $timestamps = true;
    protected $fillable = array('name', 'hospital', 'city_id', 'age', 'blood_type', 'number_cases', 'mobile_number', 'hospital_address', 'notes', 'client_id', 'latitude', 'longitude');

    public function client()
    {
        return $this->belongsTo('App\Client');
    }


    // relation between donation orders and  notifications is one to one 
    public function notification()
    {
        return $this->hasOne('App\Notifications');
    }

    public function city()
    {
        return $this->belongsTo('App\City');
    }

}