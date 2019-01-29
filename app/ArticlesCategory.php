<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArticlesCategory extends Model 
{

    protected $table = 'articles_category';
    public $timestamps = true;
    protected $fillable = array('category_name', 'article_id');

    public function articles()
    {
        return $this->hasMany('App\Article');
    }

}