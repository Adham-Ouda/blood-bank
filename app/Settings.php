<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    protected $table = 'settings';
    public $timestamps = true;
    protected $fillable = array('second_slide', 'about_app', 'address', 'mobile_number', 'phone', 'website', 'social_media_channels', 'latitude' , 'longitude', 'email');
}
