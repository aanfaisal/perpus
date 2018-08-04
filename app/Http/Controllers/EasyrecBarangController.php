<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Buku; 
use Easyrec,Session,DB;

class EasyrecBarangController extends Controller
{
	public function view(Buku $buku)
	{
		$itemid 		 	= 140;
		$itemdescription 	= 'ini tes easyrec';
		$itemurl 			= 'http://perpus.dev/easyrecLihatBuku/140';
		$sessionid			= Session::getId();
		$userid				= 10;
		$buku = Easyrec::view($itemid, $itemdescription, $itemurl, $userid, $itemimageurl = null, $actiontime = null, $itemtype = null, $sessionid = null);
		 return response()->json($buku);
	}

	public function index()
	{
		$data['buku_list'] = DB::table('buku')
							->join('penulis','buku.id_penulis','=','penulis.id')
							->join('penerbit','buku.id_penerbit','=','penerbit.id')
							->join('tahun_terbit','buku.id_tahun','=','tahun_terbit.id')
							->select('buku.*','penulis.nm_penulis','penerbit.nm_penerbit','tahun_terbit.tahun')
							->get();

		$data['jumlah_buku'] = DB::table('buku')
							->count();

		return response()->json($data);
	}
    
}
