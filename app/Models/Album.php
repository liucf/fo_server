<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function fojings(){
        return $this->hasMany('App\Models\Fojing')->orderBy('sort');
    }
}
