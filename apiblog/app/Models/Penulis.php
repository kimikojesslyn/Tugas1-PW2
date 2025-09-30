<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penulis extends Model
{
     protected $fillable = ['nama','email'];
     public function blog(){
        return $this->hasMany(Blog::class);  
    }
}
