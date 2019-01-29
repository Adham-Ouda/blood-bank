<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model 
{

    protected $table = 'favorites';
    public $timestamps = true;
    protected $fillable = array('client_id', 'article_id');

}