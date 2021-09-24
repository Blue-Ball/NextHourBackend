<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PackageFeature extends Model
{
    protected $fillable = [
        'name'
    ];

    public function package(){
        return $this->hasMany('App\Package');
    }
}
