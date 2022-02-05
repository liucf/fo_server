<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fojing extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function album(){
        return $this->belongsTo('App\Models\Album');
    }
}
