<?php
 
namespace App;

use Illuminate\Database\Eloquent\Model;
//use Sofa\Eloquence\Eloquence;

class Peminjaman extends Model
{
   // use Eloquence;

   // protected $searchableColumns = ['name'];

	public $table = 'peminjaman';
    public $fillable = ['kode','id_anggota', 'tgl_pinjam', 'tgl_kembali'];

    protected $dates = ['tgl_pinjam','tgl_kembali'];
    
    public function anggota()
    {
    	return $this->belongsTo('App\Anggota','id_anggota');
    }

    public function buku()
    {
    	return $this->belongsToMany('App\Buku', 'peminjaman_buku', 'id_peminjaman', 'id_buku')->withTimeStamps();
    }

    // mendapatkan id buku dalam peminjaman buku (update)
    public function getPeminjamanBukuAttribute(){
        return $this->buku->pluck('id')->toArray();
    }

    public function peminjaman_buku()
    {
        return $this->hasMany('App\Peminjaman_buku', 'id_buku');
    } 

}