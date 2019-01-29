<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model 
{

    protected $table = 'articles';
    public $timestamps = true;
    protected $fillable = array('title', 'body', 'image', 'articles_category_id');

    public function articlesCategory()
    {
        return $this->belongsTo('App\ArticlesCategory');
    }

    public function clients()
    {
        return $this->belongsToMany('App\Client'/*,'favorites','client_id','article_id'*/);
    }

}