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

        return $this->belongsToMany('App\Model\Group');
    }

    public function places(){
        return $this->hasMany('App\Model\Place');
    }

    public function veichless(){
        return $this->hasMany('App\Model\Vehicle');
    }

    public function contacts(){
        return $this->hasMany('App\Model\Contact');
    }

    public function photos(){
        return $this->hasMany('App\Model\Photo');
    }

    public function notes(){
        return $this->hasMany('App\Model\Note');
    }

}
