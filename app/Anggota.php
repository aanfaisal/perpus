<?php

namespace App;
// use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
 
class Anggota extends Model
{
	// use Searchable;
	
    protected $table = 'anggota';

    protected $fillable = ['nis','nama_anggota','tgl_lahir','jenis_kelamin','telepon','alamat','foto1'];

    protected $dates = ['tgl_lahir'];

    // public function searchableAs()
    // {
    //     return 'anggota_index';
    // }

    // public function toSearchableArray()
    // {
    //     return [
    //         'nis' => $this->nis,
    //         'nama_anggota' => $this->nama_anggota
    //     ];
    // }

    public function peminjaman()
    {
        return $this->hasMany('App\Peminjaman', 'id_anggota');
    }

    public function keuangan(){
        return $this->hasMany('App\Keuangan','id_anggota');
    }
}
