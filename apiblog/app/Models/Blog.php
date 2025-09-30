<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = ['judul','isi','tanggal_penulisan','penulis_id'];
    public function Penulis(){
        return $this->belongsTo(Penulis::class, 'penulis_id', 'id');
    }
}
