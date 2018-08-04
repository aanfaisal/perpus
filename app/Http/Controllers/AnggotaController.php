<?php

namespace App\Http\Controllers; 

use Illuminate\Http\Request; 
use App\Anggota;
use Validator,Response,PDF,File,Image,Carbon\Carbon,DB; 
use Illuminate\Support\Facades\Input;
use Yajra\Datatables\Datatables;


class AnggotaController extends Controller 
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
        return view ('anggota.index');
    }

    public function getAnggota(Datatables $datatables)
    {
        $query = Anggota::query();

        return $datatables->eloquent($query) 

                          ->addColumn('tanggal', function ($query) {
                            return $query->tgl_lahir->format('d-m-Y');
                            })

                          ->addColumn('action', function ($query) {
                            return 

                            '<a href="#" class="btn btn-xs bg-olive modalMd" data-toggle="modal" data-target="#modalMd" value='.action("AnggotaController@show",["id"=>$query->id]).'><i class="glyphicon glyphicon-info-sign"></i> Detail</a> '.

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
            'nis'               => 'required|max:30',
            'nama_anggota'      => 'required|max:30',
            'tgl_lahir'         => 'required|date',
            'jenis_kelamin'     => 'required|in:L,P',
            'telepon'           => 'sometimes|numeric|digits_between:10,15|unique:anggota,telepon',
            // 'alamat'            => 'required|string|max:50',
            'foto1'             => 'sometimes|image|max:500|mimes:jpeg,jpg,bmp,png',
            ]);

        if ($validasi->fails()) {
            return Response::json(array('errors' => $validasi->getMessageBag()->toArray()));
        }

        if($request->hasFile('foto1'))
        {
            $data['foto1']  = $this->uploadFoto($request);
        }  

        $data['tgl_lahir'] = Carbon::parse($data['tgl_lahir'])->format('Y-m-d');
                
        $anggota = Anggota::create($data);
        return response()->json($anggota);
    }

    private  function uploadFoto(Request $request)
    {
        $foto = $request->file('foto1');
        $ext  = $foto->getClientOriginalExtension();
        if($request->file('foto1'))
        {
            $foto_name      = date('YmdHis'). ".$ext";
            $upload_path    = 'fotoanggota';

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
    public function show(Anggota $anggota)
    {
        return view('anggota.show', compact('anggota'))->renderSections()['main'];  
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Anggota $anggota)
    {
        return response()->json($anggota);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Anggota $anggota)
    {
        $data = $request->all();

        $validasi = Validator::make($data, [
            'nis'               => 'required|max:30',
            'nama_anggota'      => 'required|max:30',
            'tgl_lahir'         => 'required|date',
            'jenis_kelamin'     => 'required|in:L,P',
            'telepon'           => 'sometimes|numeric|digits_between:10,15|unique:anggota,telepon,'.$anggota->id,
            // 'alamat'            => 'required|string|max:50',
            'foto1'             => 'sometimes|image|max:500|mimes:jpeg,jpg,bmp,png',
            ]);

        if ($validasi->fails()) {
            return Response::json(array('errors' => $validasi->getMessageBag()->toArray()));
        }

        if ($request->hasFile('foto1')) {
            $this->hapusFoto($anggota);
            $data['foto1']   = $this->uploadFoto($request);
        }

        $data['tgl_lahir'] = Carbon::parse($data['tgl_lahir'])->format('Y-m-d');

        $anggota->update($data);
        return response()->json($anggota);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Anggota $anggota)
    {
        $this->hapusFoto($anggota);
        $anggota->delete();               
        return response()->json($anggota);
    }

    private function hapusFoto(Anggota $anggota)
    {           
        if(isset($anggota->foto1))
        {
            $upload_path    = 'fotoanggota';
            $delete = File::delete($upload_path .'/'.$anggota->foto1);
            if($delete)
            {
                return true;
            }
            return false;
        }
    }

    public function cari_pdf()
    {

        $data['anggota_list'] = DB::table('anggota')                                        
                                ->select('jenis_kelamin')  
                                ->groupBy('jenis_kelamin')                     
                                ->get();

        $data['anggota_list1'] = DB::table('anggota')                                        
                                ->select('nis')  
                                ->groupBy('nis')                     
                                ->get();
                            
        return view('anggota.pilihan_pdf',$data);                                                                                              
    }

    public function dwn_pdf()
    {
        // ini_set('max_execution_time', 0); 

        $kata_kunci   = Input::get('kata_kunci');           

        $data['anggota_list'] = DB::table('anggota')
                                ->where('jenis_kelamin',$kata_kunci)
                                ->select('anggota.*')
                                ->get();

        return view('anggota.cetak',$data);  

        /*$pdf = PDF::loadView('anggota.cetak', $data)
                    ->setPaper('legal', 'landscape')
                    //->page_text(72, 18, "Header: {PAGE_NUM} of {PAGE_COUNT}", $font, 6, array(0,0,0))
                    ->stream('anggota_seleksi.pdf');

        return $pdf; */                                               
    }

    public function semua_pdf()
    {      

        $data['anggota_list'] = DB::table('anggota')                                 
                                ->get();

        return view('anggota.cetak',$data);

/*        $pdf = PDF::loadView('anggota.cetak', $data)
                    ->setPaper('legal', 'landscape') 
                    //->page_text(72, 18, "Header: {PAGE_NUM} of {PAGE_COUNT}", $font, 6, array(0,0,0))
                    ->stream('anggota.pdf');

        return $pdf;  */                                              
    }

    public function dwn_pdfKartu(Request $request)
    {
        $data           = $request->all();
        $validasi       = Validator::make($data,[
            'kata_kunci1'     => 'required',
            'kata_kunci2'    => 'required',            
            ]);

        // untuk validasi input 
        if ($validasi->fails()) {
            return redirect ('anggota/cari_pdf')
            ->withInput()
            ->withErrors($validasi);
        }

        $kata_kunci1  = Input::get('kata_kunci1'); 
        $kata_kunci2  = Input::get('kata_kunci2');           

        $data['anggota_list'] = DB::table('anggota')
                                ->where('nis','>=', $kata_kunci1)
                                ->where('nis','<=', $kata_kunci2)
                                ->select('anggota.*')
                                ->get();

        return view('anggota.kartu',$data);    
        // return response()->json($data);   
                                                                                        
    }

    public function semua_pdfKartu()
    {        
        $data['anggota_list'] = DB::table('anggota')
                                ->select('anggota.*')
                                ->get();

        return view('anggota.kartu',$data);    
        // return response()->json($data);                                            
    }


}
