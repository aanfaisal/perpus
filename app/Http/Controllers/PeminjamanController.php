<?php
  
namespace App\Http\Controllers; 
  
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input; 
use App\Peminjaman;
use App\Anggota;
use App\Buku;
use App\Peminjaman_buku; 
use Validator,Session,Response,PDF,Carbon\Carbon;  

class PeminjamanController extends Controller
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
	public function index() 
	{
		$data['peminjaman_list']    = Peminjaman::join('peminjaman_buku', 'peminjaman.kode', '=', 'peminjaman_buku.id_peminjaman')                           
			                           ->select('peminjaman.*', DB::raw('count(peminjaman_buku.id_peminjaman) as total'))
			                           ->groupBy('peminjaman_buku.id_peminjaman')
			                           ->get();

		// $data['peminjaman_list']    = Peminjaman::orderBy('kode','asc')->get();						
		$data['jumlah_peminjaman']  = DB::table('peminjaman')->count(); 

		return view('peminjaman.index',$data);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		$data['kode']           = $this->auto_kode();
		$data['buku_list']   	= Buku::pluck('judul','id');
		$data['anggota_list']   = Anggota::pluck('nama_anggota','id');
		$data['id_peminjaman']  = Peminjaman::pluck('id')->last();
		$data['i']				= 0;
		$tgl1 					= date('d-m-Y');
		$data['tgl_kembali']	= date('d-m-Y', strtotime('+7 days', strtotime($tgl1)));
		
		return view('peminjaman.create', $data);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request,Peminjaman $peminjaman)
	{
		
		$data           = $request->all();
		$validasi       = Validator::make($data,[
			'kode'          => 'required',
			'id_anggota'    => 'required',
			'tgl_pinjam'    => 'required',
			'tgl_kembali'   => 'required',
			
			]);

		// untuk validasi input 
		if ($validasi->fails()) {
			return redirect ('peminjaman/tambah')
			->withInput()
			->withErrors($validasi);
		}

		DB::beginTransaction();
			try 
			{   
				// $jml_buku     = Input::get('jml_buku');

				// if ($jml_buku <= 1) {
				

				$peminjaman = DB::table('peminjaman')->insert([
					'kode'         => Input::get('kode'),
					'id_anggota'   => Input::get('id_anggota'),
					'tgl_pinjam'   => Carbon::parse(Input::get('tgl_pinjam'))->format('Y-m-d'),
					'tgl_kembali'  => Carbon::parse(Input::get('tgl_kembali'))->format('Y-m-d'), 
					'created_at'   => Carbon::now()->format('Y-m-d'),
					'updated_at'   => Carbon::now()->format('Y-m-d')
					]);


					foreach (Session::get('items') as $value) 
					{
						// $id1   = Input::get('id_peminjaman'); //RUBAH DARI STR KE INTEGER			
						// $idp  = (int)$id1+1; 
						$peminjaman_buku = DB::table('peminjaman_buku')->insert([

									'id_peminjaman'  => Input::get('kode'),
									'id_buku'        => $value['id'],                               
									'created_at'     => Carbon::now()->format('Y-m-d'),
									'updated_at'     => Carbon::now()->format('Y-m-d')

								]);

						$id    		= $value['id'];
	             		$stok  		= $value['stok'];
	                 	$jumlah    	= $stok - 1;

		                DB::table('buku')
		                    ->where('id',$id)
		                    ->update(['stok'=> $jumlah]); 


						Session::forget('items');
						Session::forget('kode');
					}					
					

			}
			
			catch(\Illuminate\Database\QueryException $e) 
			{
				DB::rollback();
				return redirect()->back()->with('errorMessage', 'Integrity Constraint');
			}

			DB::commit();

			$x = Input::get('kode');
			Session::flash('flash_message', 'Peminjaman '.$x.' Telah Dibuat');
			return Redirect('peminjaman');
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	// $kode di dapat dari route kode
	public function show($kode) 
	{  	
		// manytoMany
        $data['data1'] = DB::table('peminjaman') 
                            ->join('peminjaman_buku', 'peminjaman.kode', '=', 'peminjaman_buku.id_peminjaman')                   
                            ->leftJoin('buku', 'peminjaman_buku.id_buku', '=', 'buku.id')
                            ->leftJoin('penulis', 'buku.id_penulis', '=', 'penulis.id')
                            ->leftJoin('penerbit', 'buku.id_penerbit', '=', 'penerbit.id')
                            ->leftJoin('tahun_terbit', 'buku.id_tahun', '=', 'tahun_terbit.id')
                            ->select('peminjaman_buku.id_peminjaman as id_peminjaman','peminjaman_buku.id_buku as id_buku','buku.*','penulis.*','penerbit.*','tahun_terbit.*')
                            ->where('peminjaman.kode', $kode)
                            ->get();
        // oneToMany
        $data['data2'] = DB::table('peminjaman')
                            ->join('anggota', 'peminjaman.id_anggota', '=', 'anggota.id')      
                            ->select('peminjaman.kode', 'peminjaman.tgl_pinjam','peminjaman.tgl_kembali', 'anggota.*')
                            ->where('peminjaman.kode', $kode)
                            ->first();
        // oneToMany
        $data['data3']    = Peminjaman::join('peminjaman_buku', 'peminjaman.kode', '=', 'peminjaman_buku.id_peminjaman')                           
			                           ->select(DB::raw('count(peminjaman_buku.id_buku) as total'))
			                           ->where('peminjaman_buku.id_peminjaman', $kode)
			                           ->get();

        return view('peminjaman.show', $data);
	}

	/**
	 * Show the form for editing the specified resource. 
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Peminjaman $peminjaman)
	{
		$data['kode']           = $this->auto_kode();
		$data['buku_list']      = Buku::pluck('judul','id');
		$data['anggota_list']   = Anggota::pluck('nama_anggota','id');

		return view('peminjaman.edit',compact('peminjaman'),$data);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Peminjaman $peminjaman)
	{
		$x = Input::get('kode');
		$peminjaman->update($request->all());
		$peminjaman->buku()->sync($request->input('peminjaman_buku'));
		Session::flash('flash_message_edit', 'Peminjaman '.$x.' Telah Diperbarui');
		return redirect('peminjaman');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Peminjaman $peminjaman)
	{
		// eloquent
		$kode = $peminjaman->kode;

		// oneToMany
        $data['data2'] = DB::table('peminjaman')
                            ->join('anggota', 'peminjaman.id_anggota', '=', 'anggota.id')      
                            ->select('peminjaman.kode', 'peminjaman.tgl_pinjam','peminjaman.tgl_kembali', 'anggota.*')
                            ->where('peminjaman.kode', $kode)
                            ->first();

        $tgl        	= strtotime($data['data2']->tgl_kembali) ;
		$tgl_skrng  	= strtotime(date("Y-m-d"));
		$durasi      	= ($tgl - $tgl_skrng) / 86400 ;
		$id_anggota		= $data['data2']->id;
		$denda 			= 500*$durasi*(-1);


		// querybuilder
		$data5 = DB::table('peminjaman') 
                            ->join('peminjaman_buku', 'peminjaman.kode', '=', 'peminjaman_buku.id_peminjaman')                   
                            ->leftJoin('buku', 'peminjaman_buku.id_buku', '=', 'buku.id')
                            ->select('buku.id as id_buku','buku.stok')
                            ->get();

        foreach ($data5 as $buku) 
        {
        	$id        = $buku->id_buku;
			$stok      = $buku->stok;
			$jumlah    = $stok + 1;	

			DB::table('buku')
				->where('id',$id)
				->update(['stok'=> $jumlah]);  
        }

        DB::table('keuangan')
				->where('id',$id)
				->where('id_pinjam',$kode)
				->insert([
					'id_pinjam'		=> $kode,
					'id_anggota' 	=> $id_anggota,
					'id_buku'		=> $id,
					'denda'			=> $denda,
					'created_at'   	=> Carbon::now()->format('Y-m-d'),
					'updated_at'   	=> Carbon::now()->format('Y-m-d')
				]); 

        // eloquent
        $peminjaman->delete();
   		Session::flash('flash_message_hapus', 'Peminjaman '.$kode.' Telah Dihapus');

		return redirect('peminjaman');
	}

	//mendapatkan variabel/instance dari url
	public function hps_buku()
	{
	   
		// $id_peminjaman = $peminjaman->id;
		// $buku       = $buku->id; 

		$id_peminjaman  = Input::get('id_peminjaman');
		$id_buku        = Input::get('id_buku');
		$stok           = Input::get('stok');
		$buku           = Input::get('buku');
		$id_anggota		= Input::get('anggota');
		$durasi 		= Input::get('durasi');
		$denda 			= 500*$durasi*(-1);

		DB::table('peminjaman_buku')
				->where('id_peminjaman',$id_peminjaman)
				->where('id_buku',$id_buku)
				->delete(); 

		// $stok   = $buku->stok;
		$jumlah = $stok + 1;

		DB::table('buku')
				->where('id',$id_buku)
				->update(['stok' => $jumlah ]);   

		DB::table('keuangan')
				->where('id',$id_buku)
				->insert([
					'id_pinjam'		=> $id_peminjaman,
					'id_anggota' 	=> $id_anggota,
					'id_buku'		=> $id_buku,
					'denda'			=> $denda,
					'created_at'   	=> Carbon::now()->format('Y-m-d'),
					'updated_at'   	=> Carbon::now()->format('Y-m-d')
				]);

		Session::flash('flash_message_hapus', 'Buku '.$buku.' Telah Dihapus ');

		return redirect()->back();
	}

	public function auto_kode()
	{
		$prefix = 'PIN';
		$code   = DB::select('select max(kode) as code from peminjaman');
	   /* $code   = DB::table('peminjaman')
					->select('max(kode) as code')
					->get();*/
		foreach ($code as $key)
		{
			$kode = substr($key->code, 3,4);
		}
		
		$plus = $kode+1;
		if($plus < 10)
		{
			$id = $prefix."000".$plus;
		}
		else
		{
			$id = $prefix."00".$plus;
		}

		return $id;
	}
										
	public function cari_pdf()
	{
		// $data           = $request->all();
		// $validasi       = Validator::make($data,[
		// 	'tgl1'      => 'required',
		// 	'tgl2'    	=> 'required',
		// 	]);

		// // untuk validasi input
		// if ($validasi->fails()) {
		// 	return redirect ('peminjaman/cari_pdf')
		// 	->withInput()
		// 	->withErrors($validasi);
		// }

		$data['anggota_list'] = DB::table('anggota')                                        
								->select('anggota.id','anggota.nama_anggota')
								->orderBy('nama_anggota')                             
								->get();
							
		return view('peminjaman.pilihan_pdf',$data);                                              
	}

	public function dwn_pdf()
	{

		$data['tgl11'] = Input::get('tgl1');
		$data['tgl22'] = Input::get('tgl2'); 

		$data['kata_kunci']   = Input::get('kata_kunci');

		$data['peminjaman_list']    = Peminjaman::join('peminjaman_buku', 'peminjaman.kode', '=', 'peminjaman_buku.id_peminjaman')                           
			                           ->select('peminjaman.*', DB::raw('count(peminjaman_buku.id_peminjaman) as total'))
			                           ->groupBy('peminjaman_buku.id_peminjaman')
			                           ->where(function ($query){
											$tgl1 = Input::get('tgl1');
											$tgl2 = Input::get('tgl2'); 
											$query->whereDate('tgl_pinjam','>=', $tgl1)
												  ->whereDate('tgl_pinjam','<=', $tgl2);
										})
										->orwhere('id_anggota',$data['kata_kunci'])
										->orderBy('kode','desc')
										->get();

		return view('peminjaman.cetak',$data);
 
		/*$pdf = PDF::loadView('peminjaman.cetak',$data)
			  ->setPaper('legal', 'landscape')
			  //->page_text(72, 18, "Header: {PAGE_NUM} of {PAGE_COUNT}", $font, 6, array(0,0,0))
			  ->stream('peminjaman_seleksi.pdf');

		return $pdf;*/                                                           
	}

	public function semua_pdf()
	{

		$data['tgl11'] = Input::get('tgl1');
		$data['tgl22'] = Input::get('tgl2'); 

		$data['peminjaman_list']    = Peminjaman::join('peminjaman_buku', 'peminjaman.kode', '=', 'peminjaman_buku.id_peminjaman')                           
			                           ->select('peminjaman.*', DB::raw('count(peminjaman_buku.id_peminjaman) as total'))
			                           ->groupBy('peminjaman_buku.id_peminjaman')
			                           ->orderBy('kode','desc')
			                           ->get();

		return view('peminjaman.cetak',$data);	                      


		// $data['peminjaman_list']    = Peminjaman::orderBy('kode','desc')
		// 								->get();

		/*$pdf = PDF::loadView('peminjaman.cetak', $data)
					->setPaper('legal', 'landscape');                    

		return $pdf->stream('peminjaman.pdf');*/                                               
	}

	// Pengujian auto item +++++++++++++++++++++++++++++++++++++++

	public function auto_item() //mengunakan jqueryUi
	{
		$term = Input::get('term');
	
		$results = array();

		// dengan ES
		$queries = Buku::search($term)->get();
		

		// tanpa ES 
		// $queries = Buku::where('judul', 'LIKE', '%'.$term.'%')
		// 		   ->orWhere('id', 'LIKE', '%'.$term.'%')
		// 		   ->get();   
		

		foreach ($queries as $query)
		{          
			$results[] = [
							'id'            =>$query->id,  
							'value'         =>$query->judul, //harus "value" -> jQueryUi                          
							'id_penulis'    =>$query->penulis->nm_penulis,
							'id_penerbit'   =>$query->penerbit->nm_penerbit,
							'id_tahun'      =>$query->tahun_terbit->tahun,
							'stok'          =>$query->stok,
						   
						 ];
		}

		return Response::json($results);
	}

	public function addItem(Request $request)
	{
		$rules = [
				   'judul'     		=> 'required',
				   'id_penulis'     => 'required',
				   'id_penerbit'    => 'required',
				   'id_tahun'       => 'required',
				   'stok'       	=> 'required'
				   
				 ];

		$data  = [

				  'id'             => Input::get('id'),                 
				  'judul'		   => Input::get('judul'),//didapat dari form create
				  'id_penulis'     => Input::get('id_penulis'),
				  'id_penerbit'    => Input::get('id_penerbit'),
				  'id_tahun'       => Input::get('id_tahun'),
				  'stok'     	   => Input::get('stok')
				 
				 ];

		$validator = Validator::make($data, $rules);


			if($validator->fails())
			{
				return response()->json([
					'success' => false,
					'errors'  => $validator->errors()->toArray(),
					'is_rules'  => 0
					]);
			}

		Session::put('kode', Input::get('kode'));
		Session::put('id_anggota', Input::get('id_sekolah'));
		Session::put('tgl_pinjam', Input::get('tgl_pinjam'));
		Session::put('tgl_kembali', Input::get('tgl_kembali'));

		$temp = [

					'id'            => Input::get('id'),                 
					'judul'    		=> Input::get('judul'),//didapat dari ajax
					'id_penulis'    => Input::get('id_penulis'),
					'id_penerbit'   => Input::get('id_penerbit'),
					'id_tahun'      => Input::get('id_tahun'),
					'stok'     	    => Input::get('stok')

				];
		
		
			if(!is_null(Session::get('items')))
			{
				$arrtmp = Session::get('items');
				$exist = FALSE;         
				foreach ($arrtmp as $key => $value) 
				{
					if(Input::get('id') == $value['id'])
					{
						$exist = TRUE;
					};
				}
			
				$stok = Input::get('stok');	
				$x 	= Input::get('judul');

				if($exist or $stok = 0)
				{
					// Session::flash('flash_message', 'Peminjaman '.$x.' Telah Dibuat');
					return response()->json([
					'errors'   => Input::get('judul').' sudah di pilih',
					]);
				}
			}
			
		Session::push('items', $temp);
		return response()->json([
			   'success'  => true,
			   'data' => $temp
			   ]);

		
	}

	public function hapus($id) 
	{
		if (Session::has('items') && is_array(Session::get('items'))) {
			$arr = Session::get('items');
			unset($arr[$id]);

			$arr = array_values($arr);
			Session::put('items', $arr);
			
			return back();
		}
	}

	// public function cetak_pinjam(Peminjaman $peminjaman)
	// {  	
	// 	return view('peminjaman.cetak_pinjam',compact('peminjaman'));
	// }

	public function cetak_pinjam($kode) 
	{  	
		// manytoMany
        $data['data1'] = DB::table('peminjaman')
                            ->join('peminjaman_buku', 'peminjaman.kode', '=', 'peminjaman_buku.id_peminjaman')                   
                            ->leftJoin('buku', 'peminjaman_buku.id_buku', '=', 'buku.id')
                            ->leftJoin('penulis', 'buku.id_penulis', '=', 'penulis.id')
                            ->leftJoin('penerbit', 'buku.id_penerbit', '=', 'penerbit.id')
                            ->leftJoin('tahun_terbit', 'buku.id_tahun', '=', 'tahun_terbit.id')
                            ->select('peminjaman_buku.id_peminjaman as id_peminjaman','peminjaman_buku.id_buku as id_buku','buku.*','penulis.*','penerbit.*','tahun_terbit.*')
                            ->where('peminjaman.kode', $kode)
                            ->get();
        // oneToMany
        $data['data2'] = DB::table('peminjaman')
                            ->join('anggota', 'peminjaman.id_anggota', '=', 'anggota.id')      
                            ->select('peminjaman.kode', 'peminjaman.tgl_pinjam','peminjaman.tgl_kembali', 'anggota.*')
                            ->where('peminjaman.kode', $kode)
                            ->first();
        // oneToMany
        $data['data3']    = Peminjaman::join('peminjaman_buku', 'peminjaman.kode', '=', 'peminjaman_buku.id_peminjaman')                           
			                           ->select(DB::raw('count(peminjaman_buku.id_buku) as total'))
			                           ->where('peminjaman_buku.id_peminjaman', $kode)
			                           ->get();

        return view('peminjaman.cetak_pinjam', $data);
	}


	// public function cetak_pinjam_pdf(Peminjaman $peminjaman)
	// { 
	// 	$pdf = PDF::loadView('peminjaman.cetak_pinjam',compact('peminjaman'))
	// 				->setPaper('legal', 'landscape');                    

	// 	return $pdf->stream('peminjaman_buku.pdf');   	
	// }

	public function cetak_pinjam_pdf($kode) 
	{  	
		// manytoMany
        $data['data1'] = DB::table('peminjaman') 
                            ->join('peminjaman_buku', 'peminjaman.kode', '=', 'peminjaman_buku.id_peminjaman')                   
                            ->leftJoin('buku', 'peminjaman_buku.id_buku', '=', 'buku.id')
                            ->leftJoin('penulis', 'buku.id_penulis', '=', 'penulis.id')
                            ->leftJoin('penerbit', 'buku.id_penerbit', '=', 'penerbit.id')
                            ->leftJoin('tahun_terbit', 'buku.id_tahun', '=', 'tahun_terbit.id')
                            ->select('peminjaman_buku.id_peminjaman as id_peminjaman','peminjaman_buku.id_buku as id_buku','buku.*','penulis.*','penerbit.*','tahun_terbit.*')
                            ->where('peminjaman.kode', $kode)
                            ->get();
        // oneToMany
        $data['data2'] = DB::table('peminjaman')
                            ->join('anggota', 'peminjaman.id_anggota', '=', 'anggota.id')      
                            ->select('peminjaman.kode', 'peminjaman.tgl_pinjam','peminjaman.tgl_kembali', 'anggota.*')
                            ->where('peminjaman.kode', $kode)
                            ->first();
        // oneToMany
        $data['data3']    = Peminjaman::join('peminjaman_buku', 'peminjaman.kode', '=', 'peminjaman_buku.id_peminjaman')                           
			                           ->select(DB::raw('count(peminjaman_buku.id_buku) as total'))
			                           ->where('peminjaman_buku.id_peminjaman', $kode)
			                           ->get();

		/*$pdf = PDF::loadView('peminjaman.cetak_pinjam',$data)
					->setPaper('legal', 'landscape');                    

		return $pdf->stream('peminjaman_buku.pdf');*/  

        return view('peminjaman.cetak_pinjam', $data);
	}

}
















// $data['peminjaman_list']    = Peminjaman::join('peminjaman_buku', 'peminjaman.kode', '=', 'peminjaman_buku.id_peminjaman')                           
// 			                           ->select('peminjaman.*', DB::raw('count(peminjaman_buku.id_peminjaman) as total'))
// 			                           ->groupBy('peminjaman_buku.id_peminjaman')
// 			                           ->get();

		  

// 		// $data['peminjaman_list']    = Peminjaman::orderBy('kode','asc')->get();						
// 		$data['jumlah_peminjaman']  = DB::table('peminjaman')->count(); 




	// public function cek_stok_buku(Request $request)
	// {
	// 	$data           = $request->all();
	// 	$validasi       = Validator::make($data,[
	// 		'id_buku'       => 'required',

	// 		]);

	   // untuk validasi input
		// if ($validasi->fails()) {
		//     return redirect ('peminjaman/tambah')
		//             ->withInput()
		//             ->withErrors($validasi);
		// }

		// simpan input dari form
		// $peminjaman = Peminjaman::create($data);

		// simpan data relasi many to many
	// 	$peminjaman->buku()->attach($request->input('id_buku'));

	// 	// mendapatkan atribut manyTo many versi query bulider
	// 	 foreach($peminjaman->buku as $data){
	// 		 $id        = $data->id;
	// 		 $stok      = $data->stok;
			
	// 	}  

	// 	$peminjaman = new Peminjaman;
	// 	$peminjaman->buku->stok   = $buku->$stok;

	// 	if ($stok <= 0) {
	// 			 return redirect('buku');
	// 		 }         

	// 	return redirect('peminjaman'); 
	// }

	// public function cari(Request $request){
	//     $kata_kunci  = Input::get('kata_kunci');  

	//     if (!empty($kata_kunci)) {
	//         $data['peminjaman_list']    = Peminjaman::orderBy('kode','asc');                              
	//         // $paginate                   = $data['peminjaman_list']->paginate(2);            
	//         $data['peminjaman_list']    = $data['peminjaman_list']->paginate();
	//         $data['pagination']         = $data['peminjaman_list']->appends($request->except('page'));
	//         $data['jumlah_peminjaman']  = $data['pagination']->total();

	//     return view('peminjaman.index',$data);
	//         }   

	//         return redirect('peminjaman');        
	// }
































