<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model 
{

    protected $table = 'clients';
    public $timestamps = true;
    protected $fillable = array('name', 'email', 'birth_date', 'city_id', 'mobile_number', 'password', 'last_donation_date', 
        'blood_type');

    public function donationsOrders()
    {
        return $this->hasMany('App\DonationOrders');
    }

    public function notifications()
    {
        return $this->belongsToMany('App\Notification','client_notification','client_id','notifications_id');
    }

    public function city()
    {
        return $this->belongsTo('App\City');
    } 

  /*  public function city()
    {
        return $this->hasOne('App\City');
    }*/

    public function bloodType()
    {
        return $this->belongsToMany('App\BloodType','blood_type_client','client_id','blood_type_id');
    }

    public function favorites()
    {
        //return $this->belongsToMany('App\Article');
        return $this->belongsToMany('App\Article','favorites'/*,'client_id','article_id'*/);
    }

    public function report()
    {
        return $this->hasMany('App\Report', 'client_id');
    }

    public function cityclient()
    {
        return $this->hasMany('App\CityClient');
    }

    public function tokens() 
    {
        return $this->hasMany('App\Token');
    }

    protected $hidden = [
        'password', 'api_token',
    ];

}