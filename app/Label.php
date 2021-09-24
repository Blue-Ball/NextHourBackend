<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Label extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function movies()
    {
        return $this->hasMany('App\Movie');
    }

    public function tvseries()
    {
        return $this->hasMany('App\TvSeries');
    }
}
