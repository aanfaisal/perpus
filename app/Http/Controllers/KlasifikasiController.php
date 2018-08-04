<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request; 
use Validator,Response,PDF,DB; 
use Yajra\Datatables\Datatables;
use App\Klasifikasi; 

class KlasifikasiController extends Controller
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
        return view ('klasifikasi.index');
    }

    public function getKlasifikasi(Datatables $datatables) 
    {
        $query = Klasifikasi::query();

        return $datatables->eloquent($query)
                          ->addColumn('action', function ($query) {
                            return 

                            '<a href="#" class="btn btn-xs bg-olive modalMd" data-toggle="modal" data-target="#modalMd" value='.action("KlasifikasiController@show",["id"=>$query->id]).'><i class="glyphicon glyphicon-info-sign"></i> Detail</a> '.

                            '<button value='.$query->id.' class="edit-modal btn bg-orange btn-xs glyphicon glyphicon-edit">Edit</button>'.

                            ' <button value='.$query->id.' class="hapus-modal btn btn-xs bg-maroon btn-xs glyphicon glyphicon-trash">Hapus</button>';                             
                            
                            })
                          ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data  = $request->all();

        $validasi = Validator::make($data,[
            'kelas'          => 'required|max:3',
            'ket'            => 'required|string|max:50',
            ]);
    
        if ($validasi->fails()) {
            return Response::json(array('errors' => $validasi->getMessageBag()->toArray()));
        }
        
        $klasifikasi = Klasifikasi::create($data); 
        return response()->json($klasifikasi); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Klasifikasi $klasifikasi)
    {
        return view('klasifikasi.show',compact('klasifikasi'))->renderSections()['main'];
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Klasifikasi $klasifikasi)
    {
        return response()->json($klasifikasi);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Klasifikasi $klasifikasi)
    {
        $data  = $request->all();

        $validasi = Validator::make($data,[
            'kelas'       => 'required|max:3',
            'ket'         => 'required|string|max:50',
            ]);
    
        if ($validasi->fails()) {
            return Response::json(array('errors' => $validasi->getMessageBag()->toArray()));
        }

        $klasifikasi->update($data);
        return response()->json($klasifikasi);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Klasifikasi $klasifikasi)
    {
        $klasifikasi->delete();
        return response()->json($klasifikasi);
    }

    public function semua_pdf()
    {
        $data['klasifikasi_list'] = DB::table('klasifikasi')                                          
                                ->get();

        return view('klasifikasi.cetak',$data);
                            
        /*$pdf = PDF::loadView('klasifikasi.cetak', $data)
                    ->setPaper('legal', 'portrait')
                    //->page_text(72, 18, "Header: {PAGE_NUM} of {PAGE_COUNT}", $font, 6, array(0,0,0))
                    ->stream('klasifikasi.pdf');

        return $pdf;  */                          
    }

    // public function cetak_semua()
    // {
    //     $data['klasifikasi_list'] = DB::table('klasifikasi')                                          
    //                             ->get();
                            
    //     return view('klasifikasi.cetak',$data);                                                                                              
    // }
}
