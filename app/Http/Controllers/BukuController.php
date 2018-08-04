<?php

namespace App\Http\Controllers;  

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller; 
use Illuminate\Support\Facades\Input; 
use App\Buku; 
use App\Klasifikasi;
use App\Penerbit;
use App\Penulis; 
use App\Tahun_terbit;
use Validator,Carbon\Carbon,PDF,Response,Image,File;
use Yajra\Datatables\Datatables;

  

class BukuController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth',['except' => ['cari','showf','cariSql','homepage','cariAuto']]);
    }
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
    {

    	// $data['penulis_list']     = Penulis::pluck('nm_penulis','id');
    	$data['penulis_list']		= Penulis::select('id','nm_penulis')->get();
    	$data['penerbit_list']		= Penerbit::select('id','nm_penerbit')->get();
    	$data['tahun_list']			= Tahun_terbit::select('id','tahun')->get();
        $data['klasifikasi_list']   = Klasifikasi::select('id','ket')->get();

        return view ('buku.index',$data,compact('buku'));
    }

    public function getBuku(Datatables $datatables) 
    {
        $query = Buku::query();
        return $datatables->eloquent($query)

        				->addColumn('penulis', function ($query) {
        					return $query->penulis->nm_penulis;
        					})

        				->addColumn('penerbit', function ($query) {
        					return $query->penerbit->nm_penerbit;
        					})

        				->addColumn('tahun', function ($query) {
        					return $query->tahun_terbit->tahun;
        					})

                        ->addColumn('klasifikasi', function ($query) {
                            return $query->klasifikasi->ket;
                            })

                        ->addColumn('action', function ($query) {
                            return 

                            '<a href="#" class="btn btn-xs bg-olive modalMd" data-toggle="modal" data-target="#modalMd" value='.action("BukuController@show",["id"=>$query->id]).'><i class="glyphicon glyphicon-info-sign"></i> Detail</a> '.

                            // '<a href="#" class="btn btn-xs bg-orange modalMd" data-toggle="modal" data-target="#modalMd" value='.action("BukuController@edit",["id"=>$query->id]).'><i class="glyphicon glyphicon-info-sign"></i> Edit</a> '.

                            '<button value='.$query->id.' class="edit-modal btn bg-orange btn-xs glyphicon glyphicon-edit">Edit</button>'.

                            ' <button value='.$query->id.' class="hapus-modal btn btn-xs bg-maroon btn-xs glyphicon glyphicon-trash">Hapus</button>';                             
                            
                            })
                          ->make(true);
    }

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		$data = $request->all();

        $validasi   = Validator::make($data,[
            // 'judul'             => 'required|max:30',
            'id_penulis'      	=> 'required',
            'id_penerbit'       => 'required',
            'id_tahun'     		=> 'required',
            'id_klasifikasi'    => 'required',
            'jumlah'            => 'required|integer|max:200',
            // 'deskripsi'         => 'sometimes|max:1000',
            'cover'             => 'sometimes|image|max:500|mimes:jpeg,jpg,bmp,png',
            ]);

        if ($validasi->fails()) 
        {
            return Response::json(array('errors' => $validasi->getMessageBag()->toArray()));
        }

        if($request->hasFile('cover'))
        {
            $data['cover']  = $this->uploadFoto($request);
        } 

		$data['stok'] = $data['jumlah'];

        $buku = Buku::create($data);

        return response()->json($buku);
    }

    private  function uploadFoto(Request $request)
    {
        $foto = $request->file('cover');
        $ext  = $foto->getClientOriginalExtension();
        if($request->file('cover'))
        {
            $foto_name      = date('YmdHis'). ".$ext";
            $upload_path    = 'coverbuku';

            // $request->file('foto1')->move($upload_path, $foto_name);

            Image::make($foto)->resize(225,225)->save($upload_path.'/'.$foto_name);

            return $foto_name;
        }
        return false;
    }

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show(Buku $buku)
	{
		
		return view ('buku.show', compact('buku'))->renderSections()['main'];  
	}

    public function showf(Buku $buku)
    {
        
        return view ('frontend.show', compact('buku'))->renderSections()['main'];  
    }

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Buku $buku)	
	{										
		return response()->json($buku);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Buku $buku)
	{
		$data = $request->all();

        $validasi   = Validator::make($data,[
            'judul'             => 'required',
            'id_penulis'      	=> 'required',
            'id_penerbit'       => 'required',
            'id_tahun'     		=> 'required',
            'id_klasifikasi'    => 'required',
            'jumlah'            => 'required|numeric|max:200',
            // 'deskripsi'         => 'sometimes|max:100',
            'cover'             => 'sometimes|image|max:500|mimes:jpeg,jpg,bmp,png',
            ]);

        if ($validasi->fails()) 
        {
            return Response::json(array('errors' => $validasi->getMessageBag()->toArray()));
        }

        if($request->hasFile('cover'))
        {
        	$this->hapusFoto($buku);
            $data['cover']  = $this->uploadFoto($request);
        } 

		$data['stok'] = $data['jumlah'];

        $buku->update($data);

        return response()->json($buku);
	}

	private function hapusFoto(Buku $buku)
    {           
        if(isset($buku->cover))
        {
            $upload_path    = 'coverbuku';
            $delete = File::delete($upload_path .'/'.$buku->cover);
            if($delete)
            {
                return true;
            }
            return false;
        }
    }

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Buku $buku)
	{
	   	$this->hapusFoto($buku);
        $buku->delete();               
        return response()->json($buku);
	}

    public function cari_pdf(){

		$data['penulis_list'] = DB::table('penulis')										
								->select('penulis.id','penulis.nm_penulis')
								->orderBy('nm_penulis')								
								->get();

		$data['penerbit_list'] = DB::table('penerbit')										
								->select('penerbit.id','penerbit.nm_penerbit')
								->orderBy('nm_penerbit')								
								->get();

		$data['tahun_list'] = DB::table('tahun_terbit')										
								->select('tahun_terbit.id','tahun_terbit.tahun')
								->orderBy('tahun')								
								->get();

        $data['klasifikasi_list'] = DB::table('klasifikasi')                                     
                                ->select('klasifikasi.id','klasifikasi.ket')
                                ->orderBy('ket')                              
                                ->get();

							//->where('nama','LIKE','%'.$kata_kunci.'%');
							
		return view('buku.pilihan_pdf',$data); 																								
	}

	public function dwn_pdf(){

		$kata_kunci   = Input::get('kata_kunci');
		$kata_kunci1  = Input::get('kata_kunci1');
		$kata_kunci2  = Input::get('kata_kunci2');		

		$data['buku_list'] = DB::table('buku')
							->join('penulis','buku.id_penulis','=','penulis.id')
							->join('penerbit','buku.id_penerbit','=','penerbit.id')
							->join('tahun_terbit','buku.id_tahun','=','tahun_terbit.id')
							->select('buku.*','penulis.nm_penulis','penerbit.nm_penerbit','tahun_terbit.tahun')							
							->where('penulis.id','=',$kata_kunci)
							->orwhere('penerbit.id','=',$kata_kunci1)
							->orwhere('tahun_terbit.id','=',$kata_kunci2)
							->orderBy('judul','asc')
							->get();

        return view('buku.cetak',$data);

		// $pdf = PDF::loadView('buku.cetak', $data)
  //       			->setPaper('legal', 'portrait')
  //       			//->page_text(72, 18, "Header: {PAGE_NUM} of {PAGE_COUNT}", $font, 6, array(0,0,0))
  //       			->stream('buku_seleksi.pdf',array("Attachment" => false));

  //       return $pdf;												
	}

	public function semua_pdf()
    {
    	$data['buku_list'] = DB::table('buku')
							->join('penulis','buku.id_penulis','=','penulis.id')
							->join('penerbit','buku.id_penerbit','=','penerbit.id')
							->join('tahun_terbit','buku.id_tahun','=','tahun_terbit.id')
							->select('buku.*','penulis.nm_penulis','penerbit.nm_penerbit','tahun_terbit.tahun')			
							->orderBy('judul','asc')
							->get(); //pake get biar gk error Undefined property: 

        return view('buku.cetak',$data);


/*        $pdf = PDF::loadView('buku.cetak', $data)
        			->setPaper('legal', 'portrait')
        			//->page_text(72, 18, "Header: {PAGE_NUM} of {PAGE_COUNT}", $font, 6, array(0,0,0))
        			->stream('buku_semua.pdf');

        return $pdf; */       
    }
    
    public function homepage(Buku $buku)
    {
        $start  = microtime(true);
        $datas  = Buku::orderby('judul','asc')->paginate(12); 
        $jumlah = Buku::count();
        $waktu  =(microtime(true) - $start);
        return view('frontend.index', compact('datas','waktu','jumlah','buku'));
    }

    // ES
    public function cariAuto(Request $request)
    {
        $term   = $request->get('q');
        // $term = 'Aaliyah';
        $results = Buku::search($term)->get(); 
        // $results = Buku::where('judul', 'like', '%' . $term . '%')->get();
        return response()->json($results);
    }


    // pengujian searching++++++++++++++++++++++++++++++++++++++++++++++++++++

    // ES
    public function cari(Request $request)
    {
        // $query = 'teori bilangan';
        $query      = $request->get('q');
        $start      = microtime(true);
        $hasil      = Buku::search($query)  
                                          ->paginate(12)
                                          ->appends($request->except('page'));
        $jumlah     = $hasil->total();
        $waktu      =(microtime(true) - $start);
        return view('frontend.hasil',compact('hasil','query','waktu','jumlah'));
        // return response()->json($hasil);
    }

    // tanpa ES
    public function cariSql(Request $request)
    {
        $searchString = 'teori bilangan';

        $start  = microtime(true);
        // $searchString = $request->get('q');

        $hasil  =   Buku::where('judul', 'like', '%' . $searchString . '%')

                    ->orWhereHas('penulis', function($query) use ($searchString){
                    $query->where('nm_penulis', 'like', '%'.$searchString.'%');
                    })

                    ->orWhereHas('penerbit', function($query) use ($searchString){
                        $query->where('nm_penerbit', 'like', '%'.$searchString.'%');
                    })

                    ->paginate(12);

        $waktu  = (microtime(true) - $start);

        // return view('frontend.hasil',compact('hasil','searchString','waktu','query'));

        return response()->json($hasil);
    }


















































 // tanpa ES
    // public function cariAuto1()
    // {
    //     $term = 'Aaliyah';
    //     // $term   = Input::get('term');
    //     $results = array();
    //     $queries  = Buku::where('judul', 'LIKE', '%'.$term.'%')
    //                 ->orWhere('id', 'LIKE', '%'.$term.'%')
    //                 ->get();   
    //     foreach ($queries as $query)
    //     {          
    //         $results[] = [
    //                         'id'            =>$query->id,  
    //                         'value'         =>$query->judul, //harus "value" -> jQueryUi                          
    //                         'id_penulis'    =>$query->penulis->nm_penulis,
    //                         'id_penerbit'   =>$query->penerbit->nm_penerbit,
    //                         'id_tahun'      =>$query->tahun_terbit->tahun,
    //                         'stok'          =>$query->stok,
                           
    //                      ];
    //     }
    //     return response()->json($results);
    // }





    /*public function cariSql()
    {
        $query = 'Jayden';
        // $data = Buku::select('judul')->paginate(5);
        $data = Buku::where('judul', 'LIKE', '%' . $query . '%')->paginate(5);
        // $data = DB::table('buku')
        //                         // ->where('judul',$query)
        //                         ->where('id_penulis','LIKE','%'.$query.'%')
        //                         ->select('buku.*')
        //                         ->get();
        return response()->json($data);
    }*/

    // public function cariSql()
    // {
    //     $searchString = 'Jayden';
    //     $data = Buku::whereHas('penulis', function($query) use ($searchString){
    //         $query->where('nm_penulis', 'like', '%'.$searchString.'%');

    //     })
    //     ->with(['penulis' => function($query) use ($searchString){
    //     $query->where('nm_penulis', 'like', '%'.$searchString.'%');
    //     }])->paginate(5);

    //     return response()->json($data);
    // }


} 
