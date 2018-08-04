<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Validator,Response,Carbon\Carbon,PDF,Session;
use Yajra\Datatables\Datatables;
use App\Tahun_terbit; 

class Tahun_terbitController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        return view ('tahun_terbit.index');
    }

    public function getTahun_terbit(Datatables $datatables)
    {
        $query = Tahun_terbit::query();

        return $datatables->eloquent($query)
                        
                          ->addColumn('action', function ($query){
                            return 

                            '<a href="#" class="btn btn-xs bg-olive modalMd" data-toggle="modal" data-target="#modalMd" value='.action("Tahun_terbitController@show",["id"=>$query->id]).'><i class="glyphicon glyphicon-info-sign"></i> Detail</a> '.

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
        $data  = $request->all();

        $validasi = Validator::make($data,[
            'tahun'     => 'required|max:4|min:4',
            ]);
    
        if ($validasi->fails()) {
            return Response::json(array('errors' => $validasi->getMessageBag()->toArray()));
        }
        
        $tahunTerbit = Tahun_terbit::create($data); 
        return response()->json($tahunTerbit);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Tahun_terbit $tahun_terbit)
    {
        return view('tahun_terbit.show',compact('tahun_terbit'))->renderSections()['main'];
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Tahun_terbit $tahun_terbit)
    {
        return response()->json($tahun_terbit);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tahun_terbit $tahun_terbit)
    {
        $data  = $request->all();

        $validasi = Validator::make($data,[
           'tahun'     => 'required|max:4',
            ]);
    
        if ($validasi->fails()) {
            return Response::json(array('errors' => $validasi->getMessageBag()->toArray()));
        }

        $tahun_terbit->update($data);
        return response()->json($tahun_terbit);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tahun_terbit $tahun_terbit)
    {
        $tahun_terbit->delete();
        return response()->json($tahun_terbit);
    }

    public function semua_pdf()
    {      

        $data['tahun_terbit_list'] = DB::table('tahun_terbit')                                 
                                ->get();

        return view('tahun_terbit.cetak',$data);

        // $pdf = PDF::loadView('tahun_terbit.cetak', $data)
        //             ->setPaper('legal', 'landscape') 
        //             //->page_text(72, 18, "Header: {PAGE_NUM} of {PAGE_COUNT}", $font, 6, array(0,0,0))
        //             ->stream('tahun_terbit.pdf');

        // return $pdf;  
    }
}
