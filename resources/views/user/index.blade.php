@extends('template')

@section('navbar')

    <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row"> 
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Data user
                        </h1>
                        <ol class="breadcrumb">
                            <li class="inactive">
                                <i class="fa fa-dashboard"></i>
                                    <a href="{{asset('/dashboard') }}">Dashboard</a> 
                            </li>
                            <li class="active">
                                user
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
@stop

@section('main')

 <div class="panel panel-primary ">
    <div class="panel-heading">
        <h3 class="panel-title">user</h3>
    </div>
        <div class="panel-body">
        <!-- /.box-header -->
            <table id="table_user" class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>                                                         
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Aksi</th>                            
                    </tr>
                </thead>             
        </table>     

        @push('scripts')
            <script>
            $(function() {
                $('#table_user').DataTable({
                    processing: true,
                    serverSide: true,
                    searching : true,
                    autoWidth : true,
                    ajax: '{!! url ('userData') !!}', 
                    columns: [
                        {data: 'name'},
                        {data: 'email'},
                        {data: 'action', orderable: false, searchable: false}
                    ]
                });
            });
            </script> 

            <script src="{{asset('assets/app/user.js')}}"></script>
            <script>

                var password = document.getElementById("password"), confirm_password = document.getElementById("confirm_password");

                function validatePassword(){
                    if(password.value != confirm_password.value) {
                        confirm_password.setCustomValidity("Passwords Don't Match");
                    } else {
                        confirm_password.setCustomValidity('');
                    }
                }

                password.onchange = validatePassword;
                confirm_password.onkeyup = validatePassword;

            </script> 

        @endpush             
                        
        <div class="table-nav">                  

            {{-- {{ link_to('user/create',' Tambah',['class'=>'btn btn-xs bg-blue glyphicon glyphicon-plus']) }} --}}

             {{-- <a class="btn btn-sm btn-success modalMdTambah" href="{{ action('UserController@create') }}" title="Upload File"><span class="glyphicon glyphicon-upload"></span> Upload Foto</a> --}}

            <div class="pull-left">
                <button id="btn_addUser" name="btn_addUser" class="btn btn-xs bg-blue glyphicon glyphicon-plus pull-right"> Tambah</button>
            </div>&nbsp;

                {{ link_to('user/semua_pdf',' Cetak',['class'=>'btn btn-xs bg-blue glyphicon glyphicon-print','target'=>'_blank']) }}

                {{-- {{ link_to('user/cari_cetak',' Cetak',['class'=>'btn btn-xs bg-blue glyphicon glyphicon-print']) }} --}}

        </div> 

      


        {{-- MODAL TAMBAH/EDIT SECTION --}}
        <div class="modal fade" id="ModalUser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <h4 class="modal-title" id="myModalLabel">Data Admin</h4>
                    </div>
                <div class="modal-body">

                <form id="frmUser">
                    
                     {!! csrf_field() !!}

                    {{-- id --}}
                    <input type="hidden" name="id_user" id="id_user"> 

                    {{-- nama admin --}}
                    <div class="form-group" >
                        <label class="control-label">Nama</label>
                        <input class="form-control" type="text" name="name" id="nm_user" placeholder="nama admin">  
                        <p class="errorNama text-center alert alert-danger hidden"></p>   
                    </div>

                    {{-- email --}}
                    <div class="form-group" >
                        <label class="control-label">Email</label>
                        <input class="form-control" name="email" type="email" name="email" id="email" placeholder="email">
                        <p class="errorEmail text-center alert alert-danger hidden"></p>     
                    </div>

                    {{-- password --}}
                    <div class="form-group" >
                        <label class="control-label">Password</label>
                        <input class="form-control" name="password" type="password" name="password" id="password" placeholder="password">
                        <p class="errorPassword text-center alert alert-danger hidden"></p>   
                          
                    </div>

                    {{-- password confirmation --}}
                    <div class="form-group" >
                        <label class="control-label">Password Confirmation</label>
                        <input class="form-control" name="password_confirmation" type="password" placeholder="Confirm Password" id="confirm_password">
                        <p class="errorPassword1 text-center alert alert-danger hidden"></p>  
                          
                    </div>

                    {{-- foto --}}
                    <div class="form-group">
                        <label class="control-label">Foto</label>
                        <input class="form-control" name="foto" type="file" placeholder="Foto" id="foto">
                        <p class="errorFoto text-center alert alert-danger hidden"></p> 
                    </div>
                    
                </form>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary fa fa-save" id="btn-save" value="add"> Simpan</button>        
                </div>

                </div>
                
                </div>
            </div>
        </div>


        {{-- MODAL HAPUS SECTION --}}
        <div class="modal fade" id="ModalHapus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="myModalLabel">Data Penulis</h4>
                </div>
                <div class="modal-body">
                     <h4 class="modal-title" id="myModalLabel">Apa Anda yakin menghapus data ini ?</h4>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn bg-orange glyphicon glyphicon-remove" id="btn-batal" value="batal"> Batal</button>
                    <button type="button" class="btn bg-maroon glyphicon glyphicon-trash" id="btn-hapus" value="hapus"> Hapus</button>
                    {{-- id --}}
                    <input type="hidden" name="id_user1" id="id_user1" value="0">
         
                </div>
                </div>
            </div>
        </div>

        
        {{-- modal detail --}}
        <div class="modal fade" id="modalMd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
              <div class="modal-content">
                  {{-- <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title" id="modalMdTitle">Detail</h4>
                  </div> --}}
                  <div class="modal-body">
                      <div class="modalError"></div>
                      <div id="modalMdContent"></div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn bg-orange glyphicon glyphicon-remove" data-dismiss="modal" id="btn-tutup" value="batal"> Tutup</button>
                </div>
              </div>
          </div>
        </div>

        
        {{-- form modal --}}
       {{--  <div class="modal fade" id="modalFormTambah" role="dialog" aria-labelledby="myModalLabel" data-keyboard="false" data-backdrop="static">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="modalMdTitle"></h4>
                    </div>
                <div class="modal-body">
                    <div class="modalError"></div>
                    <div id="modalMdContentTambah"></div>
                </div>
                </div>
            </div>
        </div>


 form modal edit
        <div class="modal fade" id="modalFormEdit" role="dialog" aria-labelledby="myModalLabel" data-keyboard="false" data-backdrop="static">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        {{-- <h4 class="modal-title" id="modalMdTitle"></h4>
                    </div>
                <div class="modal-body">
                    <div class="modalError"></div>
                    <div id="modalMdContentEdit"></div>
                </div>
                </div>
            </div>
        </div>
 --}} 



        <style>
        .modal-header {
            background-color: #3e8ecf;
            padding:9px 15px;
            color:#FFF;
            font-family:Verdana, sans-serif;
            border-bottom:1px solid #eee;
            /*border-top-left-radius: 15px;
            border-top-right-radius: 15px;*/
         }
         /* .modal-body {
            background-color: #FF7171;
            padding:9px 15px;
            color:#000;
            font-family:Verdana, sans-serif;
            border-bottom:4px solid #C49F0F;
         
         } 
        .modal-footer {
            background-color: #FAEDBC;
            color:#FFF;
            border-bottom-left-radius: 15px;
            border-bottom-right-radius: 15px;
         } */
        </style>
                        
@stop

