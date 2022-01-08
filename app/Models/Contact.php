<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'contact',
        'contacttype',
        'relationship',
        'note',
        'updatedfrom'
    ];

    public function subject(){
        return $this->belongsTo('App\Models\Subject');
    }
}
