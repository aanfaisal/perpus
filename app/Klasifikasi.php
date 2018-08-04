<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Klasifikasi extends Model
{
   	protected $table = 'klasifikasi';

    protected $fillable = ['kelas','ket'];

    public function buku(){
    	return $this->hasMany('App\Buku', 'id_klasifikasi');
    }
}
