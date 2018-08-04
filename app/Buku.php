<?php

namespace App;

use Laravel\Scout\Searchable; 

use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use Searchable;
    
    protected $table = 'buku';

    protected $fillable = ['judul','id_penulis','id_penerbit','id_tahun','id_klasifikasi', 'deskripsi','jumlah','stok','cover'];

    protected $dates = ['created_at'];

    public function peminjaman()
    {    
    	return $this->belongsToMany('App\Peminjaman', 'peminjaman_buku', 'id_buku', 'id_peminjaman')->withTimeStamps();
    } 

    public function penerbit(){
    	return $this->belongsTo('App\Penerbit', 'id_penerbit');
    }

    public function penulis(){
    	return $this->belongsTo('App\Penulis', 'id_penulis');
    }

    public function klasifikasi(){
        return $this->belongsTo('App\Klasifikasi', 'id_klasifikasi');
    }

    public function tahun_terbit(){
        return $this->belongsTo('App\Tahun_terbit', 'id_tahun');
    }

    public function keuangan(){
        return $this->hasMany('App\Keuangan','id_buku');
    }

    public function toSearchableArray()
    {
        $data = $this->toArray();

        $data['klasifikasi'] = 
        [
            'ket' => $this->klasifikasi->ket,
        ];

        $data['penulis'] = 
        [
            'nm_penulis' => $this->penulis->nm_penulis,
        ];

        $data['penerbit'] = 
        [
            'nm_penerbit' => $this->penerbit->nm_penerbit,
        ];

        $data['tahun_terbit'] = 
        [
            'tahun' => $this->tahun_terbit->tahun,
        ];

        // unset($data['created_at'], $data['updated_at']);

        return $data;
    }

    
}
