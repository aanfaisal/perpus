<?php

namespace App\Http\Controllers; 

use Illuminate\Http\Request;
 
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Validator,Response,Carbon\Carbon,PDF,Session;
use Yajra\Datatables\Datatables;
use App\Penerbit;

class PenerbitController extends Controller
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
        return view ('penerbit.index');
    }

    public function getPenerbit(Datatables $datatables)
    {
        $query = Penerbit::query();

        return $datatables->eloquent($query)
                          ->addColumn('action', function ($query) {
                            return 

                            '<a href="#" class="btn btn-xs bg-olive modalMd" data-toggle="modal" data-target="#modalMd" value='.action("PenerbitController@show",["id"=>$query->id]).'><i class="glyphicon glyphicon-info-sign"></i> Detail</a> '.

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
    public function create()
    {
        return view('penerbit.create');
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
            'nm_penerbit'    => 'required|max:30',
            'tlpn'           => 'sometimes|numeric|digits_between:10,15|unique:penerbit,tlpn',
            'alamat'         => 'required|string|max:50',
            ]);
    
        if ($validasi->fails()) {
            return Response::json(array('errors' => $validasi->getMessageBag()->toArray()));
        }
        
        $penerbit = Penerbit::create($data); 
        return response()->json($penerbit); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Penerbit $penerbit)
    {
        return view('penerbit.show',compact('penerbit'))->renderSections()['main'];
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Penerbit $penerbit)
    {
        return response()->json($penerbit);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Penerbit $penerbit)
    {
        $data  = $request->all();

        $validasi = Validator::make($data,[
            'nm_penerbit'    => 'required|max:30',
            'tlpn'           => 'sometimes|numeric|digits_between:10,15|unique:penerbit,tlpn,'.$penerbit->id.',id',
            'alamat'         => 'required|string|max:50',
            ]);
    
        if ($validasi->fails()) {
            return Response::json(array('errors' => $validasi->getMessageBag()->toArray()));
        }

        $penerbit->update($data);
        return response()->json($penerbit);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Penerbit $penerbit)
    {
        $penerbit->delete();
        return response()->json($penerbit);
    }

    public function semua_pdf()
    {
        $data['penerbit_list'] = Penerbit::all();
        return view('penerbit.cetak',$data);
                            
        // $pdf = PDF::loadView('penerbit.cetak', $data)
        //             ->setPaper('legal', 'portrait')
        //             //->page_text(72, 18, "Header: {PAGE_NUM} of {PAGE_COUNT}", $font, 6, array(0,0,0))
        //             ->stream('penerbit.pdf');

        // return $pdf;                            
    }

}
