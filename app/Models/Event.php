<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    public function subjects(){
        return $this->belongsToMany('App\Models\Subject');
    }

    public function documents(){
        return $this->hasMany('App\Model\Document');
    }
}
