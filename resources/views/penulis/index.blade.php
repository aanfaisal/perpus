@extends('template')

@section('navbar') 

    <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row"> 
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Data Penulis
                        </h1>
                        <ol class="breadcrumb">
                            <li class="inactive">
                                <i class="fa fa-dashboard"></i>
                                    <a href="{{asset('/dashboard') }}">Dashboard</a> 
                            </li>
                            <li class="active">
                                Penulis
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
@stop
 
@section('main')

 <div class="panel panel-primary ">
    <div class="panel-heading">
        <h3 class="panel-title">Penulis</h3>
    </div>
        <div class="panel-body">
        <!-- /.box-header -->
            <table id="tPenulis" class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>                                                         
                        <th>Nama</th>
                        <th>Telepon</th>
                        <th>Alamat</th>
                        <th >Aksi</th>                            
                    </tr>
                </thead>                
        </table> 
         
        @push('scripts')
            <script>
            $(function() {
                $('#tPenulis').DataTable({
                    processing: true,
                    serverSide: true,
                    searching : true,
                    autoWidth : true,
                    ajax: '{!! url ('penulisData') !!}',
                    columns: [
                        {data: 'nm_penulis'},
                        {data: 'tlpn'},
                        {data: 'alamat'},
                        {data: 'action', orderable: false, searchable: false}
                    ]
                });
            });
            </script> 

            <script src="{{asset('assets/app/penulis.js')}}"></script>
        @endpush  

                                     
    {{-- {{ link_to('penulis/tambah',' Tambah',['class'=>'btn btn-xs bg-blue glyphicon glyphicon-plus']) }} --}}


    <div class="pull-left">
        <button id="btn_add" name="btn_add" class="btn btn-xs bg-blue glyphicon glyphicon-plus pull-right"> Tambah</button>
    </div>&nbsp;
                

    {{ link_to('penulis/semua_pdfPenulis',' Cetak',['class'=>'btn btn-xs bg-blue glyphicon glyphicon-print','target'=>'_blank']) }}

                

        {{-- MODAL TAMBAH/EDIT SECTION --}}
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <h4 class="modal-title" id="myModalLabel">Data Penulis</h4>
                    </div>
                <div class="modal-body">

                <form id="frmPenulis">
                    
                    {{-- nama penulis --}}
                    <div class="form-group" >
                        <label class="control-label">Nama</label>
                        <input class="form-control" type="text" name="nm_penulis" id="nm_penulis" placeholder="nama penulis">  
                        <p class="errorNama text-center alert alert-danger hidden"></p>
                    </div>

                    {{-- tlpn --}}
                    <div class="form-group" >
                        <label class="control-label">Telepon</label>
                        <input class="form-control" type="text" name="tlpn" id="tlpn" placeholder="no telepon">
                         <p class="errorTlpn text-center alert alert-danger hidden"></p>

                    </div>

                    {{-- alamat --}}
                    <div class="form-group" >
                        <label class="control-label">Alamat</label>
                        <textarea class="form-control" name="alamat" id="alamat" placeholder="alamat" placeholder="alamat" rows="10"></textarea> 
                         <p class="errorAlamat text-center alert alert-danger hidden"></p> 
                          
                    </div>
                    
                </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary fa fa-save" id="btn-save" value="add"> Simpan</button>
                    {{-- id --}}
                    <input type="hidden" name="id_penulis" id="id_penulis" value="0">
         
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
                    <input type="hidden" name="id_penulis1" id="id_penulis1" value="0">
         
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

