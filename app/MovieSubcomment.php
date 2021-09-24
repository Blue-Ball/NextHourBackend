<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MovieSubcomment extends Model
{

    protected $fillable = [
      'user_id',
      'comment_id',
      'reply'    
        
    ];

    public function movies()
    {
      return $this->belongsTo('App\Movie');
    }
     public function tvseries()
    {
      return $this->belongsTo('App\TvSeries');
    }
    public function user(){
      return $this->belongsTo('App\User','user_id','id');
    }
    public function comment()
    {
      return $this->belongsTo('App\MovieComment','comment_id','id');
    }
}