<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Penerbit extends Model
{
    protected $table = 'penerbit';

    protected $fillable = ['nm_penerbit','tlpn','alamat'];

    public function buku(){
    	return $this->hasMany('App\Buku', 'id_penerbit');
    }
}
