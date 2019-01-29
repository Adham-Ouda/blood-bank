<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BloodType extends Model 
{

    protected $table = 'blood_type';
    public $timestamps = true;
    protected $fillable = array('blood_type');

    public function client()
    {
        return $this->belongsToMany('App\Client');
    }

}