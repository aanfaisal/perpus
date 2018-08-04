<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tahun_terbit extends Model
{
    protected $table = 'tahun_terbit';

    protected $fillable = ['tahun'];

    public function buku(){
    	return $this->hasMany('App\Buku', 'id_tahun');
    }
}
