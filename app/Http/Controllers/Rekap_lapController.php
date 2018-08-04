<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\Buku;
use App\Penerbit;
use App\Anggota;
use App\Penulis; 
use App\Tahun_terbit;
use App\Peminjaman;
use Carbon\Carbon,PDF;

class Rekap_lapController extends Controller 
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function cari_pdf()
    {                            
        return view('rekap_lap_pilihan_pdf');                                              
    }

    public function dwn_pdf()
    { 

        $data['tgl11'] = Input::get('tgl1');
        $data['tgl22'] = Input::get('tgl2'); 

        $data['buku_jumlah']    = Buku::where(function ($query){
                                            $tgl1 = Input::get('tgl1');
                                            $tgl2 = Input::get('tgl2'); 
                                            $query->whereDate('created_at','>=', $tgl1)
                                                  ->whereDate('created_at','<=', $tgl2);
                                        })
                                        ->select('jumlah')
                                        ->sum('jumlah');

        $data['buku_stok']    = Buku::where(function ($query){
                                            $tgl1 = Input::get('tgl1');
                                            $tgl2 = Input::get('tgl2'); 
                                            $query->whereDate('created_at','>=', $tgl1)
                                                  ->whereDate('created_at','<=', $tgl2);
                                        })
                                        ->select('stok')
                                        ->sum('stok');

        $data['buku_pinjam'] = $data['buku_jumlah']-$data['buku_stok'];

        $data['buku_total'] = $data['buku_stok'] + $data['buku_pinjam'];

        $data['anggota_jkl']    = Anggota::where(function ($query){
                                            $tgl1 = Input::get('tgl1');
                                            $tgl2 = Input::get('tgl2'); 
                                            $query->whereDate('created_at','>=', $tgl1)
                                                  ->whereDate('created_at','<=', $tgl2);
                                        })
                                        ->where('jenis_kelamin','L')
                                        ->count('jenis_kelamin');

        $data['anggota_jkp']    = Anggota::where(function ($query){
                                            $tgl1 = Input::get('tgl1');
                                            $tgl2 = Input::get('tgl2'); 
                                            $query->whereDate('created_at','>=', $tgl1)
                                                  ->whereDate('created_at','<=', $tgl2);
                                        })
                                        ->where('jenis_kelamin','P')
                                        ->count('jenis_kelamin');

         $data['anggota_total']  = $data['anggota_jkl']+$data['anggota_jkp'];

         $data['peminjaman_jumlah']    = Peminjaman::where(function ($query){
                                            $tgl1 = Input::get('tgl1');
                                            $tgl2 = Input::get('tgl2'); 
                                            $query->whereDate('created_at','>=', $tgl1)
                                                  ->whereDate('created_at','<=', $tgl2);
                                        })
                                        ->count('kode');


        return view('rekap_lap',$data);                                                        
    }

    public function index()
    {
        $data['tgl11'] = Input::get('tgl1');
        $data['tgl22'] = Input::get('tgl2'); 

        $data['buku_jumlah']   = DB::table('buku')
                                ->select('jumlah')
                                ->sum('jumlah');

        $data['buku_stok']   = DB::table('buku')
                                ->select('stok')
                                ->sum('stok');

        $data['buku_pinjam'] = $data['buku_jumlah']-$data['buku_stok'];

        $data['buku_total'] = $data['buku_stok'] + $data['buku_pinjam'];

        $data['anggota_jkl']    = DB::table('anggota')
                                ->where('jenis_kelamin','L')
                                ->count('jenis_kelamin');

        $data['anggota_jkp']    = DB::table('anggota')
                                ->where('jenis_kelamin','P')    
                                ->count('jenis_kelamin');

        $data['anggota_total']  = $data['anggota_jkl']+$data['anggota_jkp'];

        $data['peminjaman_jumlah'] = DB::table('peminjaman')
                                    ->count('kode');


                                    
                                    

        $data['peminjaman_list']    = Peminjaman::all();

        return view('rekap_lap',$data);
    }

    public function rekap_lap_cetak()
    {
        $data['buku_jumlah']   = DB::table('buku')
                                ->select('jumlah')
                                ->sum('jumlah');

        $data['buku_stok']   = DB::table('buku')
                                ->select('stok')
                                ->sum('stok');

        $data['buku_pinjam'] = $data['buku_jumlah']-$data['buku_stok'];

        $data['buku_total'] = $data['buku_stok'] + $data['buku_pinjam'];

        $data['anggota_jkl']    = DB::table('anggota')
                                ->where('jenis_kelamin','L')
                                ->count('jenis_kelamin');

        $data['anggota_jkp']    = DB::table('anggota')
                                ->where('jenis_kelamin','P')
                                ->count('jenis_kelamin');

        $data['anggota_total']  = $data['anggota_jkl']+$data['anggota_jkp'];

        // $data['peminjaman_list']    = Peminjaman::all();
        
        $data['peminjaman_jumlah'] = DB::table('peminjaman')
                                    ->count('kode');


        return view('rekap_lap_cetak',$data);
    }



}
