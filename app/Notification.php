<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model 
{

    protected $table = 'notifications';
    public $timestamps = true;
    protected $fillable = array('details', 'notification_time','donation_order_id');

    public function client()
    {
        return $this->belongsToMany('App\Client');
    }
    
    // relation between donation orders and  notifications is one to one
    public function donationsOrders()
    {
        return $this->belongsTo('App\DonationOrders');
    }

}