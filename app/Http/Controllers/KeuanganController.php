<?php

namespace App\Http\Controllers;

use App\Keuangan;
use App\Anggota;
use Illuminate\Http\Request;
use Validator,Response,Carbon\Carbon,DB; 
use Illuminate\Support\Facades\Input;

class KeuanganController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function cari_pdf()
    {

        $data['anggota_list'] = DB::table('anggota')                                        
                                ->select('id','nis','nama_anggota')                      
                                ->get();
                            
        return view('keuangan.pilihan_cetak',$data);                                                                                               
    }

    public function dwn_pdf(Request $request)
    {
        $data           = $request->all();
        $validasi       = Validator::make($data,[
            'tgl1'     => 'required',
            'tgl2'     => 'required',            
            ]);

        // untuk validasi input 
        if ($validasi->fails()) {
            return redirect ('keuangan/cari_pdf')
            ->withInput()
            ->withErrors($validasi);
        }

        $kata_kunci   = Input::get('kata_kunci');
        $kata_kunci1  = Input::get('tgl1'); 
        $kata_kunci2  = Input::get('tgl2');           

        $data['keuangan_list'] = Keuangan::whereDate('created_at','>=', $kata_kunci1)
                                ->whereDate('created_at','<=', $kata_kunci2)
                                ->orWhere('id_anggota',$kata_kunci)
                                ->select('keuangan.*')
                                ->orderby('id_pinjam','asc')
                                ->get();

        return view('keuangan.cetak',$data);    
        // return response()->json($data);   
                                                                                        
    }

    public function index()
    {        
        $data['keuangan_list'] = Keuangan::select('keuangan.*')
                                ->orderby('id_pinjam','asc')
                                ->get();

        return view('keuangan.cetak',$data);      
        // return response()->json($data);                                            
    }

 
}
