<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Keuangan extends Model 
{
    protected $table = 'keuangan';

    protected $fillable = ['id_pinjam','id_anggota','id_buku','denda'];

    protected $dates = ['created_at'];

    public function anggota(){
    	return $this->belongsTo('App\Anggota', 'id_anggota');
    }

    public function buku(){
    	return $this->belongsTo('App\Buku', 'id_buku');
    }

}
