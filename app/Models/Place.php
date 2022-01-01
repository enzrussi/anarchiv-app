<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Place extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'city',
        'zipcode',
        'relationship',
        'subject_id',
        'updatedfrom',
        'note'
    ];

    public function subject(){
        return $this->belongsTo('App\Models\Subject');
    }
}
