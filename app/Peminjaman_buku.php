<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Peminjaman_buku extends Model
{
    protected $table = 'peminjaman_buku';

    protected $fillable = ['id_peminjaman','id_buku']; 

    public function peminjaman()
    {
    	return $this->belongsTo('App\Peminjaman','id_buku');
    }
}
