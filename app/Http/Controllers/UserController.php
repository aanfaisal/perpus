<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Yajra\Datatables\Datatables;
use Validator,Response,Session,Image,File,DB;

class UserController extends Controller
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
        return view('user.index');
    }

    public function getUser(Datatables $datatables)
    {
        $query = User::query();

        return $datatables->eloquent($query)
                          ->addColumn('action', function ($query) {
                            return 

                            '<a href="#" class="btn btn-xs bg-olive modalMd" data-toggle="modal" data-target="#modalMd" value='.action("UserController@show",["id"=>$query->id]).'><i class="glyphicon glyphicon-info-sign"></i> Detail</a> '.

                            '<button value='.$query->id.' class="edit-modal btn bg-orange btn-xs glyphicon glyphicon-edit">Edit</button>'.



                            // '<button value='.$query->id.' class="edit-modal btn bg-orange btn-xs glyphicon glyphicon-edit">Edit</button>'.

                            ' <button value='.$query->id.' class="hapus-modal btn btn-xs bg-maroon btn-xs glyphicon glyphicon-trash">Hapus</button>';                             
                            
                            })
                          ->make(true);
    }


    // '<a href="#" class="btn btn-xs bg-olive modalMd" data-toggle="modal" data-target="#modalMd" value='.action("UserController@show",["id"=>$query->id]).'><i class="glyphicon glyphicon-info-sign"></i> Detail</a> '.

    //                         '<button value='.$query->id.' class="edit-modal btn bg-orange btn-xs glyphicon glyphicon-edit">Edit</button>'.

    //                         ' <button value='.$query->id.' class="hapus-modal btn btn-xs bg-maroon btn-xs glyphicon glyphicon-trash">Hapus</button>';  

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.create')->renderSections()['main'];
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

        $validasi = Validator::make($data, [
            'name'      => 'required|max:255',
            'email'     => 'required|email|max:100|unique:user',
            'password'  => 'required|confirmed|min:6',
            'foto'      => 'sometimes|image|max:500|mimes:jpeg,jpg,bmp,png',
            ]);

       if ($validasi->fails()) {
            return Response::json(array('errors' => $validasi->getMessageBag()->toArray()));
        }

        if($request->hasFile('foto'))
        {
            $data['foto']  = $this->uploadFoto($request);
        }  

        // hash password
        $data['password'] = bcrypt($data['password']);
                
        $user = User::create($data);
        return response()->json($user);
    }

    private  function uploadFoto(Request $request)
    {
        $foto = $request->file('foto');
        $ext  = $foto->getClientOriginalExtension();
        if($request->file('foto')->isValid())
        {
            $foto_name      = date('YmdHis'). ".$ext";
            $upload_path    = 'fotouser';
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
    public function show(User $user)
    {
        return view('user.show',compact('user'))->renderSections()['main'];  
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        // $user = User::find($id);
        //return view('user.edit',compact('user'))->renderSections()['main'];

        return response()->json($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $data = $request->all(); 

        $validasi = Validator::make($data, [
            'name'      =>'required|max:255',
            'email'     =>'required|email|max:100|unique:user,email,'.$user->id,
            'password'  =>'sometimes|confirmed|min:6',
            ]);

        if ($validasi->fails()) {
            return Response::json(array('errors' => $validasi->getMessageBag()->toArray()));
        }

        if ($request->hasFile('foto')) {
            $this->hapusFoto($user);
            $data['foto']   = $this->uploadFoto($request);
        }

        if($request->has('password'))
        {
            // hash password
            $data['password'] = bcrypt($data['password']);
        }else
        {
            // password tidak di update
            $data = array_except($data,['password']);

        }

        $user->update($data);
        return response()->json($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy(User $user) 
    {
        $this->hapusFoto($user);
        $user->delete();

        // Session::flash('flash_message_hapus', 'User '.$user->name.' Telah Dihapus');                 
        return response()->json($user);
    }

    private function hapusFoto(User $user)
    {           
        if(isset($user->foto))
        {
            $upload_path    = 'fotouser';
            $delete = File::delete($upload_path.'/'.$user->foto);
            if($delete)
            {
                return true;
            }
            return false;
        }
    }

    public function semua_pdf()
    {      

        $data['user_list'] = DB::table('user')                                 
                                ->get();

        return view('user.cetak',$data);

/*        $pdf = PDF::loadView('anggota.cetak', $data)
                    ->setPaper('legal', 'landscape') 
                    //->page_text(72, 18, "Header: {PAGE_NUM} of {PAGE_COUNT}", $font, 6, array(0,0,0))
                    ->stream('anggota.pdf');

        return $pdf;  */                                              
    }
}
