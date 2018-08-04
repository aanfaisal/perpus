<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request; 
use Validator,Response,PDF,DB; 
use Yajra\Datatables\Datatables;
use App\Penulis; 

class PenulisController extends Controller
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
        return view ('penulis.index');
    }

    public function getPenulis(Datatables $datatables) 
    {
        $query = Penulis::query();

        return $datatables->eloquent($query)
                          ->addColumn('action', function ($query) {
                            return 

                            '<a href="#" class="btn btn-xs bg-olive modalMd" data-toggle="modal" data-target="#modalMd" value='.action("PenulisController@show",["id"=>$query->id]).'><i class="glyphicon glyphicon-info-sign"></i> Detail</a> '.

                            '<button value='.$query->id.' class="edit-modal btn bg-orange btn-xs glyphicon glyphicon-edit">Edit</button>'.

                            ' <button value='.$query->id.' class="hapus-modal btn btn-xs bg-maroon btn-xs glyphicon glyphicon-trash">Hapus</button>';                             
                            
                            })
                          ->make(true);
    }

                        

// " <button value='$index->id' onClick='HapusModal(this);' class='btn btn-danger' data-toggle='modal' data-target='#dellModal'>Hapus</button>".
// 
// '<button data-info={{345345}},{{45645}},{{34643645}},{{46456457}}" value="{{$query->id}}" data-toggle="modal" data-target="#myModal" class="open_modal btn bg-orange btn-xs glyphicon glyphicon-edit">Edit</button>'.

// '<a href="penulis/' . $query->id .'/edit "class="btn btn-xs bg-orange" id="edit_modal"><i class="glyphicon glyphicon-edit"></i> Edit</a> '.


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('penulis.create'); 
    }

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
            'nm_penulis'     => 'required|max:30',
            'tlpn'           => 'sometimes|numeric|digits_between:10,15|unique:penulis,tlpn',
            'alamat'         => 'required|string|max:50',
            ]);
    
        if ($validasi->fails()) {
            return Response::json(array('errors' => $validasi->getMessageBag()->toArray()));
        }
        
        $penulis = Penulis::create($data); 
        return response()->json($penulis); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Penulis $penulis)
    {
        return view('penulis.show',compact('penulis'))->renderSections()['main'];
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Penulis $penulis)
    {
        return response()->json($penulis);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Penulis $penulis)
    {
        $data  = $request->all();

        $validasi = Validator::make($data,[
            'nm_penulis'     => 'required|max:30',
            'tlpn'           => 'sometimes|numeric|digits_between:10,15|unique:penulis,tlpn,'.$penulis->id,
            'alamat'         => 'required|string|max:50',
            ]);
    
        if ($validasi->fails()) {
            return Response::json(array('errors' => $validasi->getMessageBag()->toArray()));
        }

        $penulis->update($data);
        return response()->json($penulis);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Penulis $penulis)
    {
        $penulis->delete();
        return response()->json($penulis);
    }

    public function semua_pdf()
    {
        $data['penulis_list'] = DB::table('penulis')                                          
                                ->get();

        return view('penulis.cetak',$data);  
                            
        /*$pdf = PDF::loadView('penulis.cetak', $data)
                    ->setPaper('legal', 'portrait')
                    //->page_text(72, 18, "Header: {PAGE_NUM} of {PAGE_COUNT}", $font, 6, array(0,0,0))
                    ->stream('penulis.pdf');

        return $pdf; */                           
    }

    // public function cetak_semua()
    // {
    //     $data['penulis_list'] = DB::table('penulis')                                          
    //                             ->get();
                            
    //     return view('penulis.cetak',$data);                                                                                              
    // }
}
