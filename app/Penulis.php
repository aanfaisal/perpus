<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Penulis extends Model
{
    protected $table = 'penulis';

    protected $fillable = ['nm_penulis','tlpn','alamat'];

    public function buku(){
    	return $this->hasMany('App\Buku','id_penulis');
    }
}
