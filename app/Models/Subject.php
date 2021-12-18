<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'surname',
        'birthdate',
        'placebirth',
        'updatedfrom'
    ];

    public function groups(){

        return $this->belongsToMany('App\Models\Group');
    }

    public function places(){
        return $this->hasMany('App\Models\Place');
    }

    public function veichless(){
        return $this->hasMany('App\Models\Vehicle');
    }

    public function contacts(){
        return $this->hasMany('App\Models\Contact');
    }

    public function photos(){
        return $this->hasMany('App\Models\Photo');
    }

    public function notes(){
        return $this->hasMany('App\Models\Note');
    }

    public function events(){
        return $this->belongsToMany('App\Models\Event');
    }

}
